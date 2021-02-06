<?php
use PhpMailer\PhpMailer\PhpMailer;
require_once "PhpMailer/PhpMailer.php";
require_once "PhpMailer/SMTP.php";
require_once "PhpMailer/Exception.php";
class Mailing
{
  
    function sendMail(string $to_address,string $subject,string $body):bool
    {

    $mail = new PHPMailer();
    
     try{
         $mail->isSMTP();                  
         $mail->Host='smtp.gmail.com';     
         $mail->SMTPAuth   = true;                                   
         $mail->Username   = 'devarlaaarya@gmail.com';                     
         $mail->Password   = 'Aasdf';                           
         $mail->SMTPSecure = "tls";        
         $mail->Port       = 587;          
     
         $mail->setFrom('devarlaaarya@gmail.com', 'Aarya');
         $mail->addAddress($to_address);     
         $mail->isHTML(true);                                      
         $mail->Subject = $subject;
         $mail->Body= $body;
         $mail->send();
         echo 'Message has been sent';
        return true;
     } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         return false;
     }
    
    }


}
