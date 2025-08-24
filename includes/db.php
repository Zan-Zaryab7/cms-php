<?php

$host = '
db.fr-pari1.bengt.wasmernet.com';
$user = 'root';
$pwd = '';
$db = 'court_case_management';

$con = new mysqli($host, $user, $pwd, $db);

if ($con->connect_errno) {
    error_log("MySQLi Connection failed: " . $con->connect_error);
    exit("Database connection failed.");
}
