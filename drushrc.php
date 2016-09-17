<?php

// The first example "statusss" is just a simple test
// to make sure your environment is reading this file
// To test, run `drush @yoursite.instance statusss`
$options['shell-aliases'] = array(
  'statusss' =>
    '!echo "\nChecking the status of {{@target}}"
    drush {{@target}} status
    echo "\nChecking the status of {{@target}} again"
    drush {{@target}} status
    echo "Finished checking the status of {{@target}} twice"',
  'data-stage' =>
    '!echo "\nReplacing the {{@target}} database with the one from {{#stage}}"
    drush sql-sync -y {{#stage}} {{@target}} --create-db --sanitize',
  'data-live' =>
    '!echo "\nReplacing the {{@target}} database with the one from {{#live}}"
    drush sql-sync -y {{#live}} {{@target}} --create-db --sanitize',
  'files-stage' =>
    '!echo "\nSyncing files from {{#stage}} to {{@target}}"
    drush rsync -y {{#stage}}:%files {{@target}}:%files',
  'files-live' =>
    '!echo "\nSyncing files from {{#live}} to {{@target}}"
    drush rsync -y {{#live}}:%files {{@target}}:%files',
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
  'rebuild' =>
    "!echo '\nRunning composer install from the project root'
    cd ..
    composer install
    drush {{@target}} data-live
    drush {{@target}} confim
    echo '\nLogging into {{@target}} as uid1'
    drush {{@target}} uli uid=1",
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
  'deploy-stage' =>
    "!echo '\nDeploying the latest state of the develop branch to staging'
    echo 'Pulling the latest develop branch'
    git checkout develop
    git pull
    echo '\nMerging develop into staging'
    git checkout staging
    git merge develop
    echo '\nCreating a release tag with the current date and time'
    echo 'Then pushing everything (including tags) to staging'
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
