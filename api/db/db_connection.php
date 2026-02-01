<?php
// Load global config
require_once '../api/common/config.php';

/**
 * ----------------------------------
 * Set PHP Default Timezone
 * ----------------------------------
 */
date_default_timezone_set('Asia/Kolkata');

/**
 * ----------------------------------
 * Create MySQL Connections
 * ----------------------------------
 */
$connAdmin   = mysqli_connect(ADMIN_DB_HOST, ADMIN_DB_USER, ADMIN_DB_PASS, ADMIN_DB_NAME);
$connUser    = mysqli_connect(APP_DB_HOST, APP_DB_USER, APP_DB_PASS, APP_DB_NAME);
$connPartner = mysqli_connect(PARTNER_DB_HOST, PARTNER_DB_USER, PARTNER_DB_PASS, PARTNER_DB_NAME);

/**
 * ----------------------------------
 * Connection Checks
 * ----------------------------------
 */
if (!$connAdmin) {
    die("ADMIN DB connection failed: " . mysqli_connect_error());
}

if (!$connUser) {
    die("USER DB connection failed: " . mysqli_connect_error());
}

if (!$connPartner) {
    die("PARTNER DB connection failed: " . mysqli_connect_error());
}

/**
 * ----------------------------------
 * Set MySQL Session Timezone
 * ----------------------------------
 * Asia/Kolkata = +05:30
 */
mysqli_query($connAdmin,   "SET time_zone = '+05:30'");
mysqli_query($connUser,    "SET time_zone = '+05:30'");
mysqli_query($connPartner, "SET time_zone = '+05:30'");

/**
 * ----------------------------------
 * Set Charset
 * ----------------------------------
 */
mysqli_set_charset($connAdmin, "utf8mb4");
mysqli_set_charset($connUser, "utf8mb4");
mysqli_set_charset($connPartner, "utf8mb4");
