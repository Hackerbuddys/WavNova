<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $service = htmlspecialchars($_POST['service']);
    $message = htmlspecialchars($_POST['comments']);

    // ----------------------
    // ADMIN EMAIL
    // ----------------------
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@wavnova.in';
        $mail->Password   = 'xqeq lgce qpon qcmn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('admin@wavnova.in', 'WavNova Tech Solution');
        $mail->addAddress('YOUR_PERSONAL_EMAIL');

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body = "
            <h3>New Enquiry</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Service:</strong> $service</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();

        // ----------------------
        // AUTO-REPLY TO USER
        // ----------------------
        $reply = new PHPMailer(true);
        $reply->isSMTP();
        $reply->Host       = 'smtp.gmail.com';
        $reply->SMTPAuth   = true;
        $reply->Username   = 'admin@wavnova.in';
        $reply->Password   = 'xqeq lgce qpon qcmn';
        $reply->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $reply->Port       = 587;

        $reply->setFrom('admin@wavnova.in', 'WavNova Tech Solution');
        $reply->addAddress($email);

        $reply->isHTML(true);
        $reply->Subject = "Thank You for Contacting Us";
        $reply->Body = "
            <p>Hi $name,</p>
            <p>Thank you for reaching out. We have received your enquiry and will contact you shortly.</p>
            <p><strong>Service Selected:</strong> $service</p>
            <br>
            <p>Best Regards,<br>Your Company Name</p>
        ";

        $reply->send();

        echo "success";

    } catch (Exception $e) {
        echo "error";
    }
}
