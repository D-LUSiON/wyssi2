<?php

require 'core/settings.php';

if (file_exists('site_settings.json'))
    $site_settings = file_get_contents('site_settings.json');

if (!file_exists('site_settings.json') || $site_settings == '') {
    unset($_SESSION['user']);
    require 'core/Installer.php';
    $app = new Installer();
} else
    $app = new Application();

