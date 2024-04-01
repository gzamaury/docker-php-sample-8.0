<?php

$loader = require_once realpath(__DIR__ . '/vendor/autoload.php');
$loader->addPsr4('Utils\\', 'Utils');

use Utils\MailService;

try {
    if (isset($_POST['submit'])) {
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $recipientEmail = $_POST['recipient'];

        MailService::sendMail($subject, $body, $recipientEmail);
    }
} catch (ErrorException $e) {
    // Handle the exception
    die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sent</title>
</head>
<body>
    <h2>Email Sent</h2>
    <p>The email has been sent successfully.</p>
</body>
</html>
