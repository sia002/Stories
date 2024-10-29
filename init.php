<?php
require "classes/classDB.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED & ~E_STRICT);

define("CONFIG_LIVE", "0"); // 0: Test environment || 1: Live environment || 2: Docker

if (CONFIG_LIVE == 0) {
    $DB_SERVER = "localhost";
    $DB_NAME = "Stories";
    $DB_USER = "root";
    $DB_PASS = "root";
} else if (CONFIG_LIVE == 1) {
    $DB_SERVER = "";
    $DB_NAME = "";
    $DB_USER = "";
    $DB_PASS = "";
} else if (CONFIG_LIVE == 2) {
    $DB_SERVER = "mariadb-standard";
    $DB_NAME = "webshop";
    $DB_USER = "user";
    $DB_PASS = "secretPassword";
}

// Opretter en instans af db-klassen
$db = new db($DB_SERVER, $DB_NAME, $DB_USER, $DB_PASS);




