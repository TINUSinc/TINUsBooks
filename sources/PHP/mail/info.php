<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function crearEmail($asunto, $mensaje, $destinatario){
    $myMail = new PHPMailer();
    $myMail->CharSet = 'UTF-8'; 
    $myMail->Encoding = 'base64';
    $myMail->isSMTP();
    $myMail->Host='smtp.office365.com';
    $myMail->SMTPAuth = true;
    $myMail->Port=587;
    $myMail->Username='al289539@edu.uaa.mx';
    $myMail->Password='Pakwar10';
    $myMail->SMTPSecure='tls';
    $myMail->setFrom('al289539@edu.uaa.mx','TICER Certifications');
    $myMail->addAddress($destinatario);
    $myMail->Subject = $asunto;
    $myMail->isHTML();
    $myMail->Body=$mensaje;
    if($myMail->send()){ 
        echo "
        <div class='container'>
            <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                Se ha enviado el correo.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
        ";
    }else{
        $error = $myMail->ErrorInfo;
        echo "
        <div class='container'>
            <div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                Ha ocurrido un error, intentelo después.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
        ";
    } 
}
?>
