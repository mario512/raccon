<?php

class Mail
{

    public static function sendMailContacts($mailData)
    {

        if ($mailData) {

            $mail    = Registry::get('config')['email'];
            $subject = 'Feedback';

            $headers = array(
                'From'      => $mail,
                'Reply-To'  => $mailData['email'],
                'X-Mailer'  => 'PHP/' . phpversion()
            );

            $result = mail($mail, $subject, $mailData['text'], $headers);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
}
