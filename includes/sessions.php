<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('session.use_strict_mode', 1);
session_regenerate_id(true);
