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
     * @throws \Exception
     */
    public static function sendEmail(array $addresses, $subject, $body)
    {
        try {
            $mail = new PHPMailer();
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');
            $mail->CharSet = 'utf-8';
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            foreach ($addresses as $address) {
                $mail->addAddress($address['email'], $address['name']);
            }
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->send();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
