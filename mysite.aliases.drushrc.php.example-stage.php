<?php

/**
 * This file should be placed on the staging server at:
 * ~/.drush/mysite.aliases.drushrc.php
 *
 * Remember to add the staging site's ssh key to
 * the live server in order to use the live alias
 */

// Staging site
$aliases["stage"] = array (
 'root' => '/path/to/drupal/root',
 'uri' => 'stage.mysite.com',
 '#live' => '@mysite.live',
);

// Live site
$aliases["live"] = array (
 'uri' => 'live.mysite.com',
 'root' => '/path/to/drupal/root',
 'remote-host' => 'live.server.com',
 'remote-user' => 'username',
);
