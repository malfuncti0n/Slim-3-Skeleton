<?php

namespace App\Services;

use PHPMailer;

class Mailer {

    public function sendMail($email, $message, $subject){
        date_default_timezone_set('Europe/Athens');
        $this->mail = new PHPMailer;
        $this->mail->IsSMTP();
        $this->mail->SMTPDebug  = 3;
        $this->mail->SMTPAuth   = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Host     ="";
        $this->mail->Port       = 587;
        $this->mail->AddAddress($email);
        $this->mail->Username="";
        $this->mail->Password="";
        $this->mail->SetFrom('');
        $this->mail->AddReplyTo("");
        $this->mail->Subject    = $subject;
        $this->mail->MsgHTML($message);
        $this->mail->Send();
    }
}