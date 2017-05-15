<?php

class Mailer {
    public function welcome($email, $url) {
        $message = "<h1>Thank you for signin up !</h1>".
                "<p>Please follow this link to confirm your registration</p>".
                "<a href='$url'>Confirm my registration</a>";
        
        $subject = "Welcome !"; 
        $to  = $email;
        $headers = "From: \"Please do not reply to this email \"<noreply@noreply.com>\n";
        $headers .= "Reply-To: noreply@noreply.com\n";
        $headers .= "Content-Type: text/html; charset=\"ISO-8859-1\"";
        mail($to,$subject,$message,$headers);
    }
    
    public function sendNewPwdRequest($email, $url) {
        $message = "<h1>Changing password request</h1>".
                "<p>Please follow this link to reset your password.</p>".
                "<a href='$url'>RESET MY PASSWORD</a>";
        
        $subject = "Reset password request"; 
        $to  = $email;
        $headers = "From: \"Please do not reply to this email \"<noreply@noreply.com>\n";
        $headers .= "Reply-To: noreply@noreply.com\n";
        $headers .= "Content-Type: text/html; charset=\"ISO-8859-1\"";
        mail($to,$subject,$message,$headers);        
    }
}