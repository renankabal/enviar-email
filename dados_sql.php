<?php
	ini_set('display_errors','On');
   	include_once('public/conexao.php');

   switch ($comando)
   {
	#Envia email
	case 'enviar':
        #PHPMail
		include_once('public/phpmailer/class.phpmailer.php');
        include_once('public/phpmailer/PHPMailerAutoload.php');
        // echo $message;
		// echo $codgrupoemail;
		$assunto = 'Proesc Educacional';
        // exit();
		$usuario = 'renan@proesc.com';
		$senha = 'sucesso@2014';
		#Pega os email diretamente do BD
		$sql_email = "SELECT * FROM email WHERE codgrupoemail=$codgrupoemail and enviado <>'s'";
		$cons_email = pg_query($sql_email);
		
		#Passei fisicamente, mas pode ser passada atravéz de variável
		while ($lista_email = pg_fetch_object($cons_email)) {
			$destinatarios = $lista_email->email;

			$Host = 'smtp.proesc.com';
			$Username = $usuario;
			$Password = $senha;
			$Port = "587";

			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = $Host; // SMTP server
			$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
			// 1 = errors and messages
			// 2 = messages only
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->Port = $Port; // set the SMTP port for the service server
			$mail->Username = $Username; // account username
			$mail->Password = $Password; // account password

			$mail->SetFrom($usuario, $nomeDestinatario);
			$mail->Subject = $assunto;
			$mail->MsgHTML($message);
			$mail->AddAddress($destinatarios);

			if(!$mail->Send()) {
				$mensagemRetorno = 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
				exit();
			} else {
				$mensagemRetorno = 'E-mail enviado com sucesso!';
				pg_query("UPDATE email SET enviado='s' WHERE codemail = $lista_email->codemail");
		        #redireciona para a pagina da index
		        header("location:sucesso.php");
		    	break;
			}
		}
    }
?>
