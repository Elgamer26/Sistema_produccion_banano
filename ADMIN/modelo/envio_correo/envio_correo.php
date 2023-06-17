<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Enviarcorreo/PHPMailer/Exception.php';
require 'Enviarcorreo/PHPMailer/PHPMailer.php';
require 'Enviarcorreo/PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
class envio_correo
{
    function enviar_correo($correo, $html, $sms)
    {
        $mail = new PHPMailer(true);
        try {       //esto es una correccion para e nivel local
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username = 'computacioneinformaticauae@gmail.com'; //este debe ir en el address?
            $mail->Password = 'uae123456';                            // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($correo, 'RANCHO LEHFED');
            $mail->addAddress($correo, 'RANCHO LEHFED');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $sms;
            $mail->Body    = $html;

            $ok = $mail->send();
            if ($ok) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return "Mensaje de error: {$mail->ErrorInfo}";
        }
        exit();
    }
}
