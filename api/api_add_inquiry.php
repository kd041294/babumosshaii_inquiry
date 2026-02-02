<?php
require '../api/db/db_connection.php';
require '../api/common/email_send_body.php';   // contains buildInquiryEmailTemplate()
require  __DIR__ . '/../common/send_mail.php';       // contains sendMailService()
require __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

function respond($status, $message, $extra = [])
{
    echo json_encode(array_merge([
        "status"  => $status,
        "message" => $message
    ], $extra));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, "Invalid request method");
}

/* ---------- INPUT ---------- */
$full_name   = trim($_POST['full_name'] ?? '');
$number      = trim($_POST['contact'] ?? '');
$email       = trim($_POST['email'] ?? '');
$heads       = trim($_POST['total_guests'] ?? '');
$event_type  = trim($_POST['event_type'] ?? '');
$location    = trim($_POST['location'] ?? '');
$event_date  = trim($_POST['event_date'] ?? '');
$budget      = trim($_POST['budget'] ?? '');
$notes       = trim($_POST['notes'] ?? '');
$menu_text   = trim($_POST['menu'] ?? '');
$menu_file   = $_FILES['menu_file'] ?? null;

/* ---------- VALIDATION ---------- */
if ($full_name === '') respond(false, "Full name is required");
if ($number === '' || strlen($number) < 10) respond(false, "Valid contact number required");
if ($heads === '' || !is_numeric($heads)) respond(false, "Valid total heads required");
if ($event_type === '') respond(false, "Event type required");
if ($location === '') respond(false, "Event location required");
if ($event_date === '') respond(false, "Event date required");

/* ---------- FILE ---------- */
$menu_file_content = null;
$menu_file_name    = null;

if ($menu_file && $menu_file['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    if (!in_array($menu_file['type'], $allowedTypes)) {
        respond(false, 'Invalid file type');
    }

    $menu_file_content = file_get_contents($menu_file['tmp_name']);
    $menu_file_name    = $menu_file['name'];
}

/* ---------- SQL ---------- */
$insert_query = "INSERT INTO user_query(
    uq_user_full_name, 
    uq_user_number, 
    uq_user_email, 
    uq_user_exp_heads, 
    uq_user_event_type,
    uq_user_event_location, 
    uq_user_event_date, 
    uq_user_budget, 
    uq_user_menu_pdf, 
    uq_user_menu_pdf_content, 
    uq_additional_notes, 
    uq_any_menu
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $connUser->prepare($insert_query);
if (!$stmt) respond(false, "DB Prepare Failed", ["error" => $connUser->error]);

$stmt->bind_param(
    "ssssssssssss",
    $full_name,
    $number,
    $email,
    $heads,
    $event_type,
    $location,
    $event_date,
    $budget,
    $menu_file_name,
    $menu_file_content,
    $notes,
    $menu_text
);

/* ---------- EXECUTE ---------- */
if ($stmt->execute()) {

    /* Temp file for email attachment */
    $tempFilePath = null;
    if ($menu_file && $menu_file['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = sys_get_temp_dir() . '/' . uniqid('menu_') . '_' . $menu_file_name;
        move_uploaded_file($menu_file['tmp_name'], $tempFilePath);
    }

    /* Build Email Body */
    $emailBody = buildInquiryEmailTemplate([
        'name' => $full_name,
        'number' => $number,
        'email' => $email,
        'heads' => $heads,
        'event_type' => $event_type,
        'location' => $location,
        'event_date' => $event_date,
        'budget' => $budget,
        'menu_text' => $menu_text,
        'notes' => $notes
    ]);

    /* Send Email to Admin */
    $mailResponse = sendMailService(
        $email,                               
        $full_name,
        'New Event Inquiry Received | BabuMosshaii',
        $emailBody,
        $tempFilePath,
        [
            'babumosshaii.official@gmail.com', 
            'inquiry_customer@babumosshaii.in'        
        ]
    );

    respond(true, "Inquiry submitted successfully", [
        "inquiry_id" => $stmt->insert_id,
        "mail_status" => $mailResponse['status'] ? "sent" : "failed",
        "mail_message" => $mailResponse['message']
    ]);
} else {
    respond(false, "Insert failed", ["error" => $stmt->error]);
}

$stmt->close();
$connUser->close();
