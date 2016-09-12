<?php

/**
 * To use all of the commands in this file, you must have an alias file
 * on each server named something like "mysite.aliases.drushrc.php"
 * Examples of the content required for each environment are provided
 * In the Examples branch of this repo:
 * https://github.com/ModulesUnraveled/Drush-Shell-Aliases/tree/examples
 *
 * When setup, you could:
 *
 * Sync the prod database down to the local site by typing:
 * "drush @mysite.loc data-live"
 *
 * Or, fully rebuild your local site by typing
 * "drush @mysite.loc rebuild"
 * Which:
 * 1. Runs 'composer install'
 * 2. Syncs a copy of the live database
 * 3. Imports the current Git branch's configuration
 */

// This is just a simple test to make sure your environment is reading this file
// To test, run `drush @yoursite.instance statusss`
$options['shell-aliases'] = array(
  'statusss' =>
    '!echo "\nChecking the status of {{@target}}"
    drush {{@target}} status
    echo "\nChecking the status of {{@target}} again"
    drush {{@target}} status
    echo "Finished checking the status of {{@target}} twice"',
);

// Useful file/database management commands
// These are designed to be run on a local environment
$options['shell-aliases'] = array(
  'data-stage' =>
    '!echo "\nReplacing the {{@target}} database with the one from {{#stage}}"
    drush sql-sync -y {{#stage}} {{@target}} --create-db --sanitize',
  'data-live' =>
    '!echo "\nReplacing the {{@target}} database with the one from {{#live}}"
    drush sql-sync -y {{#live}} {{@target}} --create-db --sanitize',
  'files-stage' =>
    '!echo "\nSyncing files from {{#Stage}} to {{@target}}"
    drush rsync -y {{#Stage}}:%files {{@target}}:%files',
  'files-stage' =>
    '!echo "\nSyncing files from {{#Stage}} to {{@target}}"
    drush rsync -y {{#Stage}}:%files {{@target}}:%files',
  'files-live' =>
    '!echo "\nSyncing files from {{#live}} to {{@target}}"
    drush rsync -y {{#live}}:%files {{@target}}:%files',
);

// Useful configuration management commands
// These are designed to be run on a local environment
$options['shell-aliases'] = array(
  'confex' =>
    "!echo '\nDisabling development modules'
    drush {{@target}} pmu -y $(cat ../mods_enabled.local | tr '\n' ' ')
    echo '\nExporting configuration'
    drush {{@target}} cex -y
    echo '\nRe-enabling development modules'
    drush {{@target}} en -y $(cat ../mods_enabled.local | tr '\n' ' ')",
  'confim' =>
    "!echo '\nImporting configuration'
    drush {{@target}} cim -y
    echo '\nEnabling development modules'
    drush {{@target}} en -y $(cat ../mods_enabled.local | tr '\n' ' ')
    echo '\nUpdating database'
    drush {{@target}} updb -y
    echo '\nClearing caches'
    drush {{@target}} cr",
);

// Useful workflow commands
// These are designed to be run on a local environment
$options['shell-aliases'] = array(
  'rebuild' =>
    "!echo '\nRunning composer install from the project root'
    cd ..
    composer install
    drush {{@target}} data-live
    drush {{@target}} confim
    echo '\nLogging into {{@target}} as uid1'
    drush {{@target}} uli uid=1",
);

// Useful commands to maintain remote environments
// These are designed to be run on staging and production machines
$options['shell-aliases'] = array(
  'confim-no-dev' =>
    '!echo "\nImporting configuration"
    drush {{@target}} cim -y
    echo "\nUpdating database"
    drush {{@target}} updb -y
    echo "\nClearing caches"
    drush {{@target}} cr',
  'stage-rebuild' =>
    "!echo '\Pulling latest staging branch'
    git checkout staging
    git pull
    echo '\nRunning composer install from the project root'
    cd ..
    composer install --no-dev
    drush {{@target}} confim-no-dev
    echo '\nUse the following link to log into {{@target}} as uid1'
    drush {{@target}} uli uid=1 --no-browser",
  'live-rebuild' =>
    "!echo '\Pulling latest master branch'
    git checkout master
    git pull
    echo '\nRunning composer install from the project root'
    cd ..
    composer install --no-dev
    drush {{@target}} confim-no-dev
    echo '\nUse the following link to log into {{@target}} as uid1'
    drush {{@target}} uli uid=1 --no-browser",
);

// Useful commands for deploying yoru Git repo to stage and live
// These are designed to be run on a local environment
$options['shell-aliases'] = array(
  'deploy-stage' =>
    "!echo '\nDeploying the latest state of the develop branch to staging'
    echo 'Pulling the latest develop branch'
    git checkout develop
    git pull
    echo '\nMerging develop into staging'
    git checkout staging
    git merge develop
    echo '\nCreating a release tag with the current date and time'
    echo 'Then pushing everything (including tags) to master'
    git tag REL-STAGING-$(date +'%Y%m%d-%H%M%S')
    git push --tags
    git push origin staging
    echo '\nChecking out the develop branch'
    git checkout develop",
  'deploy-live' =>
    "!echo '\nDeploying the latest state of the staging branch to master'
    echo 'Pulling the latest staging branch'
    git checkout staging
    git pull
    echo '\nMerging staging into master'
    git checkout master
    git merge staging
    echo '\nCreating a release tag with the current date and time'
    echo 'Then pushing everything (including tags) to master'
    git tag REL-LIVE-$(date +'%Y%m%d-%H%M%S')
    git push --tags
    git push origin master
    echo '\nChecking out the develop branch'
    git checkout develop",
);
