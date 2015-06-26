<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('OopsTests', __DIR__);

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');
define('TEMP_DIR', __DIR__ . '/temp/' . (isset($_SERVER['argv']) ? md5(serialize($_SERVER['argv'])) : getmypid()));
Tester\Helpers::purge(TEMP_DIR);
