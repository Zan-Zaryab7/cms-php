<?php
$host = 'db.fr-pari1.bengt.wasmernet.com';
$user = 'b5439b0d74ba8000c36482779958';
$pwd  = '068ab543-9b0d-7670-8000-efa09b407e03';
$db   = 'court_management_system';
$port = 10272; // ✅ custom port

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $con = new mysqli($host, $user, $pwd, $db, $port);
    $con->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log("MySQL Connection Error: " . $e->getMessage());
    exit("Database connection failed. Please try again later.");
}
