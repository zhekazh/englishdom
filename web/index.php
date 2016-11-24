<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$loader = require __DIR__.'/../app/autoload.php';

$app = new App();
$app->run();
?>