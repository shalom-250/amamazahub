<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);
function init_email($mail){
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port       = $_ENV['MAIL_PORT'];
}
function sendingEmail($params) {
    global $mail;
    try {
        //Server settings
       init_email($mail);
        //Recipients
        $mail->setFrom($_ENV['MAIL_FROM']??'', $_ENV['MAIL_FROM_NAME']??'');
        $mail->addAddress($params['email']??'', $params['name']??'');
        $mail->isHTML($params['is_html']??1);
        $mail->Subject = $params['subject'] ?? $params['title']??'';
        $mail->Body    = $params['message']??$params['content']??'';
        $mail->send();
        return json_encode([
                'success'=>true,
                'message'=>'Email Has been sent!',
                'data'=>$params['email']
        ]);
        
    } catch (Exception $e) {
        return json_encode([
                'success'=>true,
                'message'=>"Message could not be sent. Mailer Error: {$mail->ErrorInfo}",
                'data'=>$params['email']
            ]);
            
    }  
}
