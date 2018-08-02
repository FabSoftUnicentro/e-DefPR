<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\User;

class Mailer
{
    /**
     * @param array $addresses
     * @param $subject
     * @param $body
     */
    public static function sendEmail(array $addresses, $subject, $body)
    {
        try {
            $mail = new PHPMailer();
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'edefpr@gmail.com';                 // SMTP username
            $mail->Password = '5ebe2294ecd0e0f08eab7690d2a6ee69'; // SMTP password
            $mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->CharSet = 'utf-8';
            $mail->setFrom('edefpr@gmail.com', 'E-DefPR');
            foreach ($addresses as $address) {
                $mail->addAddress($address['email'], $address['name']);
            }
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
        } catch (\Exception $e) {
            throw Exception($e);
        }
    }
}
