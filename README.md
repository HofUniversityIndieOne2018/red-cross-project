# TYPO3 "Red Cross Project"

This repository contains the resources and results of the lecture
Independent Course Work I in Hof University's master degree program
Software Engineering for Industrial Applications.

## Installation

* having Docker and [DDEV](https://github.com/drud/ddev) (at least version 1.5) installed
  + https://ddev.readthedocs.io/en/stable/#docker-installation
  + https://ddev.readthedocs.io/en/stable/#installation-or-upgrade-windows
* clone git repository
* execute `ddev start`
* execute `ddev composer install`
* import database using `ddev import-db --src ./ddev/database.sql.gz`

Web project is provided at [Web project is provided at [http://red-cross-project.ddev.local/](http://red-cross-project.ddev.local/)

## Deployment

[Deployer](https://deployer.org/) can be used in order to deploy application
state to a remote server in terms of a simple deployment pipeline. In order
to make use of this functionality a couple of changes are required.

* in directory `.deploy/`
  + copy `hosts.dist.yml` to `hosts.yml` and adjust configuration
  + duplicate directory `example.domain.name` and use the real target hostname as directoy name
  + adjust configuration of `.env` file in that directory - make sure to change sensitive information like passwords and encryption key  
* in project root directory (the one containing the clone of this repository or your project repository)
  + execute `ddev auth ssh` in order to advertise SSH settings and keys to DDEV Docker container
  + execute `ddev ssh` in order to use the terminal of the container directly
  + execute `vendor/bin/dep deploy production` in order to deploy your local DDEV scenario to the configured remote server or servers

## Feedback, Questions, Remarks

Please contact me either using oliver.hader.2@hof-university.de or oliver.hader@typo3.org - or create a new
issue in this GitHub repository in case feedback is only related to source code.
