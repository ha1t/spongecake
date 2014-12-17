<?php
error_reporting(E_ALL | E_STRICT);

define('ROOT_DIR', dirname(dirname(__DIR__)).'/');
define('APP_DIR', ROOT_DIR.'app/');

require_once ROOT_DIR.'vendor/dietcake/dietcake/dietcake.php';
require_once CONFIG_DIR.'bootstrap.php';
