<?php

/**
 * This file should be placed on the local machine at:
 * ~/.drush/mysite.aliases.drushrc.php
 */

// local site
$aliases["loc"] = array (
 'uri' => 'loc.mysite.com',
 'root' => '/path/to/drupal/root',
 '#loc' => '@mysite.loc',
 '#stage' => '@mysite.stage',
 '#live' => '@mysite.live',
);

// Staging site
$aliases["stage"] = array (
 'uri' => 'stage.mysite.com',
 'root' => '/path/to/drupal/root',
 'remote-host' => 'stage.server.com',
 'remote-user' => 'username',
);

// Live site
$aliases["live"] = array (
 'uri' => 'live.mysite.com',
 'root' => '/path/to/drupal/root',
 'remote-host' => 'live.server.com',
 'remote-user' => 'username',
);
