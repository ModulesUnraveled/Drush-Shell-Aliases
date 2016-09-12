# Useful Drush Commands for Drupal 8 Development
To use all of the commands in this file, you must have an alias file on each server named something like "mysite.aliases.drushrc.php". Information on examples is [provided below](#examples).

## How to Use These Commands
When setup, you could:

Sync the prod database down to the local site by typing:

`drush @mysite.loc data-live`

Or, fully rebuild your local site by typing

`drush @mysite.loc rebuild`

Which:

1. Runs "composer install" from the project root
2. Syncs a copy of the live database
3. Imports the current Git branch's configuration

## Examples
Examples of the content required for each environment's alias files are provided in the [Examples branch](https://github.com/ModulesUnraveled/Drush-Shell-Aliases/tree/examples) of this repo.
