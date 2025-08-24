<?php
include "includes/sessions.php";

if (isset($_SESSION["admin_id"])) {
    unset($_SESSION["admin_id"], $_SESSION["admin_name"]);
}
if (isset($_SESSION["lawyer_id"])) {
    unset($_SESSION["lawyer_id"], $_SESSION["lawyer_name"]);
}
if (isset($_SESSION["client_id"])) {
    unset($_SESSION["client_id"], $_SESSION["client_name"]);
}

session_unset();
session_destroy();

header("Location: index.php");
exit();
