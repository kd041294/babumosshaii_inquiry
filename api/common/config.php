<?php
// Detect environment
$host = $_SERVER['HTTP_HOST'];
$environment = '';

if ($host === 'localhost' || strpos($host, '127.0.0.1') !== false) {
    $environment = 'local';
    define('BASE_URL', 'http://localhost/babumosshaii_form/');
    define('PARTNER_BASE_URL', 'http://localhost/babumosshaii_partners/');
    define('SECRET_KEY', 'f4a9c2e1b5d3f1e6a7b8c9d0e2f3a4b5c6d7e8f9a0b1c2d3e4f5a6b7c8d9e0f1');
    define('EXPENSE_ACCESS_CODE', 'DEV_A9xB3pQ7rT2mL6zW');
} else if ($host === 'localhost:8383' || strpos($host, '127.0.0.1') !== false) {
    $environment = 'local';
    define('BASE_URL', 'http://localhost:8383/babumosshaii_form/');
    define('PARTNER_BASE_URL', 'http://localhost:8383/babumosshaii_partners/');
    define('SECRET_KEY', 'f4a9c2e1b5d3f1e6a7b8c9d0e2f3a4b5c6d7e8f9a0b1c2d3e4f5a6b7c8d9e0f1');
    define('EXPENSE_ACCESS_CODE', 'DEV_A9xB3pQ7rT2mL6zW');
}else {
    $environment = 'production';
    define('BASE_URL', 'https://admin.babumosshaii.in/');
    define('PARTNER_BASE_URL', 'https://partners.babumosshaii.in/');
    define('SECRET_KEY', 'f4a9c2e1b5d3f1e6a7b8c9d0e2f3a4b5c6d7e8f9a0b1c2d3e4f5a6b7c8d9e0f1');
    define('EXPENSE_ACCESS_CODE', 'PRO_A9xB3pQ7rT2mL6zW');
}

// Database credentials based on environment
if ($environment === 'local') {
    define('MENU_REDIRECT', 'http://localhost/babumosshaii_menu/');
    define('REVIEW_LINK', 'http://localhost/babumosshaii_review');
    define('ADMIN_DB_HOST', 'localhost');
    define('ADMIN_DB_NAME', 'babumosshaii_db_admin');
    define('ADMIN_DB_USER', 'root');
    define('ADMIN_DB_PASS', '');
    // App/User DB
    define('APP_DB_HOST', 'localhost');
    define('APP_DB_NAME', 'babumosshaii_db');
    define('APP_DB_USER', 'root');
    define('APP_DB_PASS', '');
    // App/Partner DB
    define('PARTNER_DB_HOST', 'localhost');
    define('PARTNER_DB_NAME', 'babumosshaii_db_partner');
    define('PARTNER_DB_USER', 'root');
    define('PARTNER_DB_PASS', '');
} else {
    define('MENU_REDIRECT', 'https://menu.babumosshaii.in/');
    define('REVIEW_LINK', 'https://review.babumosshaii.in');
    define('ADMIN_DB_HOST', '127.0.0.1');
    define('ADMIN_DB_NAME', 'u469745365_babu_20_admin');
    define('ADMIN_DB_USER', 'u469745365_bm_admin');
    define('ADMIN_DB_PASS', 'kd961194KD@');
    // App/User DB
    define('APP_DB_HOST', '127.0.0.1');
    define('APP_DB_NAME', 'u469745365_babu_20');
    define('APP_DB_USER', 'u469745365_babumosshaii');
    define('APP_DB_PASS', 'kd961194KD@');
    // App/Partner DB
    define('PARTNER_DB_HOST', '127.0.0.1');
    define('PARTNER_DB_NAME', 'u469745365_partner_db');
    define('PARTNER_DB_USER', 'u469745365_partner');
    define('PARTNER_DB_PASS', 'kd961194KD@');
}

// Site settings
// Define secret key & IV (keep them safe)
define('ENC_SECRET_KEY', 'krisyanshkumarjhaKDKJ@8910414656');
define('ENC_SECRET_IV',  'babumosshaiikitchenandcatering@2022');
define('SITE_NAME', 'Babumosshaii Admin Panel');
define('DEFAULT_TIMEZONE', 'Asia/Kolkata');
date_default_timezone_set(DEFAULT_TIMEZONE);

// Encrypt function
function encrypt_id($id)
{
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', ENC_SECRET_KEY);
    $iv  = substr(hash('sha256', ENC_SECRET_IV), 0, 16);
    $output = openssl_encrypt($id, $encrypt_method, $key, 0, $iv);
    return rtrim(strtr(base64_encode($output), '+/', '-_'), '='); // URL-safe
}

// Decrypt function
function decrypt_id($encrypted_id)
{
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', ENC_SECRET_KEY);
    $iv  = substr(hash('sha256', ENC_SECRET_IV), 0, 16);

    // Make Base64 valid again
    $encrypted_id = strtr($encrypted_id, '-_', '+/');
    $encrypted_id = base64_decode($encrypted_id);

    return openssl_decrypt($encrypted_id, $encrypt_method, $key, 0, $iv);
}

$event_type = [
    'Anniversary Party (AP)',
    'Birthday Party (BP)',
    'Cooperate Party (CP)',
    'Reception Party (RP)',
    'Rice Ceremony (RP)',
    'Wedding Party (WP)',
    'Others'
];