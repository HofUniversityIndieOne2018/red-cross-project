<?php
// removed DDEV comment - it shall not be overridden by DDEV

call_user_func(function() {
    $projectRootPath = dirname(__DIR__, 2);

    $dotEnvFile = '.env.dist';
    if (file_exists($projectRootPath . '/.env')) {
        $dotEnvPath = '.env';
    }

    $loader = new \Symfony\Component\Dotenv\Dotenv();
    $loader->overload($projectRootPath . '/' . $dotEnvFile);
});


$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename']
    = getenv('SITE_NAME');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern']
    = getenv('TYPO3_TRUSTED_HOST_PATTERN');

$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default'] = array_merge(
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default'],
    [
        'dbname' => getenv('TYPO3_DB_CONNECTIONS_DEFAULT_NAME'),
        'host' => getenv('TYPO3_DB_CONNECTIONS_DEFAULT_HOST'),
        'password' => getenv('TYPO3_DB_CONNECTIONS_DEFAULT_PASS'),
        'port' => getenv('TYPO3_DB_CONNECTIONS_DEFAULT_PORT'),
        'user' => getenv('TYPO3_DB_CONNECTIONS_DEFAULT_USER'),
    ]
);

// This mail configuration sends all emails to mailhog
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport']
    = getenv('TYPO3_MAIL_TRANSPORT');
$GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server']
    = getenv('TYPO3_MAIL_TRANSPORT_SMTP_SERVER');

// Security settings
$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']
    = getenv('TYPO3_INSTALL_TOOL_PASSWORD');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']
    = getenv('TYPO3_ENCRYPTION_KEY');

// Switching to debugging configuration in development context
if (getenv('CONTEXT') === 'development') {
    $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = true;
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = true;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = 12290;
}
