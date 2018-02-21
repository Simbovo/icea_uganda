<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/11/2016
 * Time: 10:20
 */
ini_set('max_execution_time', 60);
require_once('vendor/autoload.php');

$mail = new PHPMailer(1);

$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'allankemboi51@gmail.com';                 // SMTP username
$mail->Password = 'W@rt1n1A';                           // SMTP password
//  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'allankemboi51@gmail.com';
$mail->FromName = 'abc';
$mail->addAddress('allan@wizglobal.co.ke');               // Name is optional


//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}