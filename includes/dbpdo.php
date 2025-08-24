<?php

$user = 'b5439b0d74ba8000c36482779958';
$pwd = '068ab543-9b0d-7670-8000-efa09b407e03';
$host = 'db.fr-pari1.bengt.wasmernet.com';
$db = 'court_management_system';
$port = 10272; // ✅ custom port

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_EMULATE_PREPARES => false, // use native prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch associative arrays
];

try {
    $conpdo = new PDO($dsn, $user, $pwd, $options);
} catch (PDOException $e) {
    error_log("PDO Connection error: " . $e->getMessage());
    exit('Database connection failed.');
}
