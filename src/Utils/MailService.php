<?php

namespace Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    protected static $mailerInstance = null;

    public static function sendMail($subject, $body, $recipientEmail)
    {
        try {
            $mail = self::getMailerInstance();
            // Setting utf-8 enconding
            $mail->Encoding = 'base64';
            $mail->CharSet = "UTF-8";

            // Recipients
            $mail->setFrom(EnvVariableReader::getEnvVariable('MAIL_FROM_EMAIL'), EnvVariableReader::getEnvVariable('MAIL_FROM_NAME'));
            $mail->addAddress($recipientEmail); // Add recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body); // Convert HTML to plain text for non-HTML mail clients

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    protected static function getMailerInstance()
    {
        if (is_null(self::$mailerInstance)) {
            // Create an instance; passing `true` enables exceptions
            self::$mailerInstance = new PHPMailer(true);
            // Server settings
            self::$mailerInstance->SMTPDebug = $_SERVER['SERVER_NAME'] === 'localhost' ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF; // Enable/disable verbose debug output
            self::$mailerInstance->isSMTP(); // Send using SMTP
            self::$mailerInstance->Host = EnvVariableReader::getEnvVariable('SMTP_HOST');
            self::$mailerInstance->SMTPAuth = true; // Enable SMTP authentication
            self::$mailerInstance->Username = EnvVariableReader::getEnvVariable('SMTP_USERNAME');
            // Read the password from file path at environment variable
            $email_pass = EnvVariableReader::getPassFromEnvVarFile('EMAIL_PASSWORD_FILE_PATH');

            self::$mailerInstance->Password = $email_pass;
            self::$mailerInstance->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            self::$mailerInstance->Port = EnvVariableReader::getEnvVariable('SMTP_PORT');
        }
        return self::$mailerInstance;
    }
}
