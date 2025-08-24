<?php

// Admin
function check_admin_login(): bool
{
    return isset($_SESSION["admin_id"]);
}

function confirm_admin_login(): void
{
    if (!check_admin_login()) {
        header("Location: admin_login.php");
        exit;
    }
}

// Client
function check_client_login(): bool
{
    return isset($_SESSION["client_id"]);
}

function confirm_client_login(): void
{
    if (!check_client_login()) {
        header("Location: client_login.php");
        exit;
    }
}

// Lawyer
function check_lawyer_login(): bool
{
    return isset($_SESSION["lawyer_id"]);
}

function confirm_lawyer_login(): void
{
    if (!check_lawyer_login()) {
        header("Location: lawyer_login.php");
        exit;
    }
}
