<?php
require_once __DIR__ . '/../PHPMailer/class.phpmailer.php';

function enviarEmail(){
        $email = new PHPMailer();
        $email->SMTPSecure = "tls";
        $email->IsSMTP();                     # Enviar via SMTP
        $email->Host = $smtp['servidor'];     #Seta o SMTP
        $email->SMTPAuth = true;              #Seta SMTP autenticado
        #autentica o SMTP
        $email->Username = $smtp['usuario'];
        $email->Password = $smtp['senha'];
        $email->From = $remetente['email'];
        $email->FromName = $remetente['nome'];
        $email->Sender = $remetente['email'];
        $email->WordWrap = 50;
        $email->IsHTML(true);
        $email->AddBCC($remetente['email'], $remetente['nome']);
        $email->AddAddress($destinatario['email'], $destinatario['nome']);
        $email->Subject  = $assunto;
        $email->Body = $corpo;

        if($email->Send())
        {
            return true;
        }
        else
        {  
            return $email->ErrorInfo;
        }

}