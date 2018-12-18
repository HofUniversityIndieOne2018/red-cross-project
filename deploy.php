<?php
namespace Deployer;

require 'recipe/typo3.php';

// Project name
set('application', 'indie-one-2018');

// [Optional] Allocate tty for git clone. Default value is false.
// This allow you to enter passphrase for keys or add host to known_hosts.
set('git_tty', true);

// Shared files/dirs between deployments (override in order to get rid of .htaccess)
set('shared_files', [
    '.env'
]);
add('shared_dirs', [
    // '{{typo3_webroot}}/fileadmin', // disabled fileadmin, since handled in Git repository ("has state")
]);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
inventory('.deploy/hosts.yml');

// Terminal messages and symbols
set('SymProgress', '<info>➤</info>');
set('SymInfo', '<info>✔</info>');
set('SymError', '<error>✘</error>');
set('MsgClear', "\r\e[K\e[1A\r");

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

// check DDEV specific requirements
task('ddev:check', function() {
    if (!getenv('DDEV_URL')) {
        return;
    }
    if (!is_writable('/home/.ssh')) {
        exec(sprintf('sudo chown %s /home/.ssh', escapeshellarg(posix_getuid())));
    }
    if (!is_writable('/home/.ssh')) {
        writeln('<error>✘ Directory /home/.ssh is not writable and might lead to complictions</error>');
    }
    if (!getenv('SSH_AUTH_SOCK')) {
        writeln('<error>✘ Run "ddev auth ssh" on host machine. This requires at least DDEV version 1.4</error>');
    }
})->desc('Check DDEV specific requirements');

// Remove empty current directory in deploy path
task('server:adjust', function() {
    if (test('[ -d {{deploy_path}}/current/ ]')) {
        $contents = run('ls -1 {{deploy_path}}/current/**');
        if (empty($contents)) {
            run('rm -r {{deploy_path}}/current/');
        }
    }
})->desc('Remove empty current directory in deploy path');

// read database info from .env files into local_db_* & host_db_*
task('dotenv:load', function () {
    $projectDirectory = __DIR__;
    $hostsDirectory = __DIR__ . '/.deploy/hosts';
    $hostDotEnv = $hostsDirectory . '/' . get('hostname') . '/.env';

    if (file_exists($projectDirectory . '/.env')) {
        $localDotEnv = $projectDirectory . '/.env';
    } elseif (file_exists($projectDirectory . '/.env.dist')) {
        $localDotEnv = $projectDirectory . '/.env.dist';
    } else {
        throw new \RuntimeException(
            'No local .env or .env.dist file given in directory ' . $projectDirectory
        );
    }
    if (!file_exists($hostDotEnv)) {
        throw new \RuntimeException(
            'No host .env file given at ' . $hostDotEnv
        );
    }

    set('dotenv_file', $hostDotEnv);
    $loader = new \Symfony\Component\Dotenv\Dotenv();
    // loading .env file for local environment (basically DDEV)
    $localEnv = $loader->parse(file_get_contents($localDotEnv));
    // loading .env file for remote environment (real world server)
    $hostEnv = $loader->parse(file_get_contents($hostDotEnv));
    foreach (['NAME', 'HOST', 'USER', 'PASS', 'PORT'] as $key) {
        $lowerKey = strtolower($key);
        set('local_db_' . $lowerKey, $localEnv['TYPO3_DB_CONNECTIONS_DEFAULT_' . $key]);
        set('host_db_' . $lowerKey, $hostEnv['TYPO3_DB_CONNECTIONS_DEFAULT_' . $key]);
    }
})->desc('Read local & remote .env files');

// deploy local database to remote host for the initial release
task('database:deploy', function() {
    $releases = get('releases_list');
    if (count($releases) === 0) {
        writeln('{{SymInfo}} No releases found on remote host, pushing local database to remote host');
        invoke('database:push');
    } else {
        writeln('{{SymInfo}} Release available on remote host. Skip pushing local database to remote host');
    }
});

// push (deploy) local database to remote host (always, needs to be called explicitly)
task('database:push', function () {
    set('database_file', sha1(uniqid()) . '.sql');
    writeln('{{SymProgress}} Dumping local database to {{database_file}}');
    // create database dump
    runLocally(
        sprintf(
            'mysqldump %s -c -h %s --port %s -u %s -p%s > %s',
            escapeshellarg(get('local_db_name')),
            escapeshellarg(get('local_db_host')),
            escapeshellarg(get('local_db_port')),
            escapeshellarg(get('local_db_user')),
            escapeshellarg(get('local_db_pass')),
            get('database_file')
        )
    );
    writeln("{{MsgClear}}{{SymInfo}}");
    // upload database dump to database directory
    writeln('{{SymProgress}} Uploading file {{database_file}} to host');
    run("cd {{deploy_path}} && if [ ! -d database ]; then mkdir database; fi");
    upload('{{database_file}}', '{{deploy_path}}/database/');
    writeln("{{MsgClear}}{{SymInfo}}");
    // try to import database dump
    try {
        // @todo Optional: Create database if not existing (depends on permissons)...
        writeln('{{SymProgress}} Importing local database {{local_db_name}} into remote database {{host_db_name}}');
        $command = sprintf(
            'mysql %s -h %s --port %s -u %s -p%s',
            escapeshellarg(get('host_db_name')),
            escapeshellarg(get('host_db_host')),
            escapeshellarg(get('host_db_port')),
            escapeshellarg(get('host_db_user')),
            escapeshellarg(get('host_db_pass'))
        );
        run(
            sprintf(
                '%s < %s',
                $command,
                get('deploy_path') . '/database/' . get('database_file')
            )
        );
        // in any case remove database dump again
        run('cd {{deploy_path}} && if [ -e database/{{database_file}} ]; then rm database/{{database_file}}; fi');
        writeln("{{MsgClear}}{{SymInfo}}");

        $backendUsers = has('typo3_backend_user') ? get('typo3_backend_user') : null;
        if (is_array($backendUsers)) {
            foreach ($backendUsers as $backendUser) {
                if (empty($backendUser['username']) || empty($backendUser['password'])) {
                    writeln('{{SymError}} Both "username" and "password" must be set for "typo3_backend_user" items');
                    continue;
                }
                run(
                    sprintf(
                        '%s -e %s',
                        $command,
                        escapeshellarg(sprintf(
                            'UPDATE be_users SET password=%s WHERE username=%s AND deleted=0',
                            escapeshellarg($backendUser['password']),
                            escapeshellarg($backendUser['username'])
                        ))
                    )
                );
                writeln('{{SymInfo}} Adjusted backend user ' . $backendUser['username']);
            }
        }

    } catch (\Exception $exception) {
        writeln("{{MsgClear}}{{SymError}}");
        throw $exception;
    } finally {
        // in any case remove database dumps again
        runLocally('if [ -e {{database_file}} ]; then rm {{database_file}}; fi');
        run('cd {{deploy_path}} && if [ -e database/{{database_file}} ]; then rm database/{{database_file}}; fi');
    }
})->desc('Push local database to remote host');

task('database:flush', function () {
    if (!askConfirmation('This will REMOVE contents of remote database. Continue?')) {
        return;
    }
    $command = sprintf(
        'mysql %s -h %s --port %s -u %s -p%s',
        escapeshellarg(get('host_db_name')),
        escapeshellarg(get('host_db_host')),
        escapeshellarg(get('host_db_port')),
        escapeshellarg(get('host_db_user')),
        escapeshellarg(get('host_db_pass'))
    );
    $tableNameList = run(
        sprintf('%s -s -e %s',
            $command,
            escapeshellarg('SHOW TABLES;')
        )
    );
    foreach (explode("\n", $tableNameList) as $tableName) {
        $tableName = trim($tableName);
        if (empty($tableName)) {
            continue;
        }
        run(
            sprintf('%s -e %s',
                $command,
                escapeshellarg(sprintf('DROP TABLE %s;', $tableName))
            )
        );
        writeln('{{SymInfo}} Dropped table ' . $tableName);
    }
});

task('dotenv:deploy', function () {
    upload('{{dotenv_file}}', '{{release_path}}/.env');
})->desc('Deploy host .env file');

task('typo3:finish', function() {
    within('{{release_path}}', function () {
        // @todo .htaccess file should be part of TYPO3 CLI task
        run('if [ ! -f {{typo3_webroot}}/.htaccess ]; then cp {{typo3_webroot}}/typo3/sysext/install/Resources/Private/FolderStructureTemplateFiles/root-htaccess {{typo3_webroot}}/.htaccess; fi');
        run('vendor/bin/typo3cms install:fixfolderstructure');
        run('vendor/bin/typo3cms install:generatepackagestates');
        run('vendor/bin/typo3cms extension:setupactive');
        run('vendor/bin/typo3cms cache:flush');
    });
})->desc('Finish TYPO3 environment');


// Configuration for custom tasks

after('deploy:failed', 'deploy:unlock'); // if deployment failed
before('database:flush', 'dotenv:load'); // load .env before explicitly executing database:flush

// List of all tasks in their according order
// (manipulated with before() and after() for own tasks)

###
# ::START::
###
###
# deploy:info
###
after('deploy:info', 'ddev:check');
after('ddev:check', 'server:adjust');
### ---
before('deploy:prepare', 'dotenv:load');
###
# deploy:prepare
###
### ---
###
# deploy:lock
###
### ---
before('deploy:release', 'database:deploy');
###
# deploy:release
###
### ---
###
# deploy:update_code
###
### ---
###
# deploy:shared
###
### ---
###
# deploy:vendors
###
### ---
###
# deploy:writable
###
### ---
###
# deploy:symlink
###
after('deploy:symlink', 'dotenv:deploy');
after('dotenv:deploy', 'typo3:finish');
### ---
###
# deploy:unlock
###
### ---
###
# cleanup
###
###
# ::DONE::
###
