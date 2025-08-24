<?php

$host = 'db.fr-pari1.bengt.wasmernet.com';
$user = 'b5439b0d74ba8000c36482779958';
$pwd = '068ab543-9b0d-7670-8000-efa09b407e03';
$db = 'court_management_system';

$con = new mysqli($host, $user, $pwd, $db);

if ($con->connect_errno) {
    error_log("MySQLi Connection failed: " . $con->connect_error);
    exit("Database connection failed.");
}
