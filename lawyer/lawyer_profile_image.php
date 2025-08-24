<?php
include "../includes/dbpdo.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    exit("Invalid request");
}

$id = (int) $_GET['id'];

$stmt = $conpdo->prepare("SELECT lawyer_image, image_type FROM lawyer_login WHERE lawyer_id = ?");
$stmt->bindParam(1, $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row && !empty($row['lawyer_image'])) {
    header("Content-Type: " . $row['image_type']);
    echo $row['lawyer_image'];
} else {
    http_response_code(404);
    exit("Image not found");
}
