<?php

   include_once('public/conexao.php');

   switch ($comando)
   {
	#Envia email
	case 'enviar':
        #PHPMail
        		// ob_start();
        require('public/email/email.php');
		// $email = ob_get_contents();
        // ob_end_clean();

        $confirmacao = enviarEmail(
                            
                                #primeiro parametro -> destinatÃ¡rio,
                                #segundo parametro  -> remetente,
                                #terceiro parametro -> assunto,
                                #quarto parametro -> corpo,
                                #quinto parametro -> smtp do remetente, usuario, e senha
                                #confirmação de resposta
                                array(
                                        'email' =>  'renan@proesc.com', 
                                        'nome'   =>  'Renan jhonatha'
                                    ),
                               array(
                                        'email' => 'renan@proesc.com',
                                        'nome' => 'Renan'),
                                        'Renan',
                                'dadasddadasda',
                               array(
                                        'servidor' => 'smtp.proesc.com.br',
                                        'usuario' => 'renan@proesc.com',
                                        'senha' => 'sucesso@2014'
                                    ),
                               array(
                                        'confirmacao'   =>  false,
                                        'email' =>  ''
                                    )
);
                #Se mandar ou não

                 if($confirmacao)
                 {
                    #html do email enviado
                    #$email;
                 
                 }else{
                    echo "<script>";
                    echo "alert('O e-mail não foi enviado!');";
                    echo "location.replace('index.php');";
                    echo "</script>";
                 }

        #redireciona para a pagina de edicao
        header("location:sucesso.php");
    	break;
    }
?>
