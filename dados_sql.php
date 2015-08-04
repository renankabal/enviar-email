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
		// echo $assunto;
        // exit();
		$usuario = '****';
		$senha = '*****';

		$Host = 'smtp.****.com';
		$Username = $usuario;
		$Password = $senha;
		$Port = "587";
		#Pega os email diretamente do BD
		$sql_email = "SELECT * FROM email WHERE codgrupoemail=$codgrupoemail and enviado <>'s'";
		$cons_email = pg_query($sql_email);

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
		#Passei fisicamente, mas pode ser passada atravéz de variável
		while ($coluna = pg_fetch_array($cons_email)) {
			$email_atual = $coluna[email];			
			$mail->ClearAddresses();
			$mail->AddAddress("$email_atual");

			if(!$mail->Send()) {
				$mensagemRetorno = 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
			} else {
				pg_query("UPDATE email SET enviado='s' WHERE codemail = $coluna[codemail]");
				$mensagemRetorno = 'E-mail enviado com sucesso!';
		        #redireciona para a pagina da index
		     	header("location:index.php?envio=$codgrupoemail");
		    	// break;
			}
			// $mail->SmtpClose();
			// sleep(15);
		}
    }
?>
