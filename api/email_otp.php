<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function sendEmailOTP($email, $otp){

    $mail = new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'abc@gmail.com'; //your email address 
        $mail->Password   = 'nnfieuirufjnvmnjf'; //app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('YOUR_GMAIL@gmail.com', 'Online Voting System');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'OTP for Voting Login';
        $mail->Body    = "<h3>Your OTP is: <b>$otp</b></h3>";

        $mail->send();
        return true;

    } catch (Exception $e){
        return false;
    }
}
?>