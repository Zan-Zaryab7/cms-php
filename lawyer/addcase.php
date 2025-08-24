<?php
include "includes/db.php";

if (!isset($_SESSION["lawyer_id"], $_GET['id'], $_GET['case_id'], $_GET['status'])) {
	header("Location: lawyer_dashboard.php");
	exit();
}

$id = (int) $_SESSION["lawyer_id"];
$clientId = (int) $_GET['id'];
$caseId = (int) $_GET['case_id'];
$status = ($_GET['status'] === "accepted") ? "accepted" : "rejected";

if ($con) {
	// Update notifications
	$stmt = $con->prepare("UPDATE notifications SET accepted_status = ? WHERE lawyer_id = ? AND client_id = ?");
	$stmt->bind_param("sii", $status, $id, $clientId);
	$stmt->execute();
	$stmt->close();

	// Update cases
	$stmt1 = $con->prepare("UPDATE cases SET lawyer_status = ? WHERE lawyer_id_assigned = ? AND clientforcase_id = ? AND case_id = ?");
	$stmt1->bind_param("siii", $status, $id, $clientId, $caseId);
	$stmt1->execute();
	$stmt1->close();
}

header("Location: lawyer_dashboard.php");
exit();
