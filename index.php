<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'vendor/autoload.php';

use lib\Database\Database;
use lib\Routing\Routing;

$database = new Database();

$router = new Routing($database);
$router->init();