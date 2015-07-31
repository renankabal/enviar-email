<?php

   include_once('public/conexao.php');

   switch ($comando)
   {
	#Envia email
	case 'enviar':
        #PHPMail
		ob_start();
        require('public/PHPMailer/PHPMailer_v5.1/class.phpmailer.php');
		$email = ob_get_contents();
        ob_end_clean();

        // Inicia a classe PHPMailer
        $mail = new PHPMailer();
         
        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        //$mail->Host = "localhost"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
        // $mail->Host = "smtp.proesc.com.br";
        $mail->SMTPAuth = false; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $mail->Username = 'renan@proesc.com'; // Usuário do servidor SMTP (endereço de email)
        $mail->Password = 'sucesso@2014'; // Senha do servidor SMTP (senha do email usado)
         
        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->From = "renan@proesc.com"; // Seu e-mail
        $mail->Sender = "renan@proesc.com"; // Seu e-mail
        $mail->FromName = "Renan Jhonatha"; // Seu nome
         
        // Define os destinatário(s)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->AddAddress('renan@proesc.com', 'Teste mensagem');
        $mail->AddAddress('fantasmaapoi@gmail.com', 'Teste mensagem');
        //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
        //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
         
        // Define os dados técnicos da Mensagem
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
         
        // Define a mensagem (Texto e Assunto)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->Subject  = "Mensagem Teste"; // Assunto da mensagem
        $mail->Body = 'Este é o corpo da mensagem de teste, em HTML! 
         <IMG src="http://seudomínio.com.br/imagem.jpg" alt=":)"   class="wp-smiley"> ';
        $mail->AltBody = 'Este é o corpo da mensagem de teste, em Texto Plano! \r\n 
        <IMG src="http://www.imagenswhatsapp.com.br/wp-content/uploads/2015/04/Imagem-de-whatsapp-engra%C3%A7adas.jpg" alt=":)"  class="wp-smiley"> ';
         
        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
         
        // Envia o e-mail
        $enviado = $mail->Send();
         
        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
         
        // Exibe uma mensagem de resultado
        if ($enviado) {
        echo "E-mail enviado com sucesso!";
        } else {
        echo "Não foi possível enviar o e-mail.
         
        ";
        echo "Informações do erro: 
        " . $mail->ErrorInfo;
        }
        

        #redireciona para a pagina de edicao
        header("location:sucesso.php");
    	break;
    }
?>
