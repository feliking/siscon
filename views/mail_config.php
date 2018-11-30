<?php
    $mail->SMTPDebug = 1;                               // Enable verbose debug output
    //$mail->isMail();
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "10.0.35.8";  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    $mail->Port = 25;
    $mail->SMTPAutoTLS=false;                                    // TCP port to connect to
    //$mail->Username = $_SESSION["email"];
    //$mail->Password = $_SESSION["password"];
?>