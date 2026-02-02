<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendMailService(
    $toEmail,
    $toName,
    $subject,
    $bodyMessage,
    $attachmentPath = null,   // OPTIONAL
    $ccList = []              // 👈 NEW (array of CC emails)
) {
    $mail = new PHPMailer(true);
    $response = [
        'status'  => false,
        'message' => ''
    ];

    try {
        /* ---------- SMTP CONFIG ---------- */
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'service@babumosshaii.in';
        $mail->Password   = 'krishuKD@961194';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        /* ---------- SENDER ---------- */
        $mail->setFrom('service@babumosshaii.in', 'Service | BabuMosshaii');

        /* ---------- RECEIVER ---------- */
        $mail->addAddress($toEmail, $toName);

        /* ---------- CC SUPPORT ---------- */
        if (!empty($ccList) && is_array($ccList)) {
            foreach ($ccList as $cc) {
                if (filter_var($cc, FILTER_VALIDATE_EMAIL)) {
                    $mail->addCC($cc);
                }
            }
        }

        /* ---------- ATTACHMENT ---------- */
        if (!empty($attachmentPath) && is_string($attachmentPath) && file_exists($attachmentPath)) {
            $mail->addAttachment($attachmentPath);
        }

        /* ---------- CONTENT ---------- */
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $bodyMessage;

        /* ---------- SEND ---------- */
        $mail->send();

        $response['status']  = true;
        $response['message'] = 'Mail sent successfully';
    } catch (Exception $e) {
        $response['status']  = false;
        $response['message'] = $mail->ErrorInfo;
    }

    return $response;
}


function sendMailSupport($toEmail, $toName, $subject, $bodyMessage)
{
    $mail = new PHPMailer(true);
    $response = ['status' => false];

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@babumosshaii.in';
        $mail->Password = 'serviceBM@2021';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('support@theweddingtone.in', 'Support | Babumosshaii');
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $bodyMessage;

        $mail->send();
        $response['status'] = true;
    } catch (Exception $e) {
        $response['status'] = false;
    }
    return $response;
}
