<?php

$user = 'root';
$pwd = '';
$dsn = 'mysql:host=localhost;dbname=court_case_management;charset=utf8mb4';

$options = [
    PDO::ATTR_EMULATE_PREPARES => false, // use native prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch associative arrays by default
];

try {
    $conpdo = new PDO($dsn, $user, $pwd, $options);
} catch (PDOException $e) {
    error_log("PDO Connection error: " . $e->getMessage());
    exit('Database connection failed.');
}
