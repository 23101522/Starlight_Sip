<?php
// init.php - Should be included at the VERY TOP of every page

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
require_once 'db.php';

// Other global settings
date_default_timezone_set('Asia/Dhaka'); // Set your timezone
?>