<?php

 /**
 * @name Email
 * @author THOMAS MELO
 * @date 03-06-2021
 * 
 */
class Email extends PHPMailer{
	
	### ATRIBUTOS
	public 	  $mailer;
	protected $smtp;
	protected $username;
	protected $senha;

	### CONSTRUTOR PADRÃO #######################
	public function __construct(){

		$this->smtp 	= '';
		$this->username = '';
		$this->senha	= '';
		$this->mailer = new PHPMailer();
		$this->mailer->IsSMTP();	// Informando a classe para usar SMTP
		$this->mailer->IsHTML(true);
		$this->mailer->CharSet 		= 'UTF-8'; // Charset da mensagem (opcional)
		
		//configuração do host e smtp
		$this->mailer->SMTPAuth 	= true;  			// Ativar a autenticação SMTP
		$this->mailer->Host       	= $this->smtp;  	// servidor de SMTP
		$this->mailer->Port       	= 587;          	// Porta de envio
		// $this->mailer->Port       	= 587;          // Porta de envio
		$this->mailer->Username   	= $this->username; 	// usuario para autenticação no servidor smtp
		$this->mailer->Password   	= $this->senha;		// senha do usuario para autenticação
		$this->mailer->SMTPOptions = array(
									    'ssl' => array(
									        'verify_peer' => false,
									        'verify_peer_name' => false,
									        'allow_self_signed' => true
									    )
									);
		$this->mailer->SMTPDebug 	= 0;				// Ativar SMTP depuração
														// 0 = off (para uso em produção)
														// 1 = mensagens do cliente
														// 2 = cliente e servidor
		
		// configuração do e-mail padrão de envio
		// Define o endereço de email de onde vai partir da mensagem
		// Em geral é igual ao Username
		
		$this->mailer->SetFrom('seu@email.com.br', 'Seu Nome');
		
	}
	#### FECHA CONSTRUTOR PADRÃO ###################
	
	###  METODO DE ENVIO #####################
	/**
	 * @name enviar
	 * @access public
	 * @date 03-06-2021
	 * @author THOMAS MELO
	 * @param $emailPara		- STRING - E-mail que irá receber a mensagem
	 * @param $nomePara			- STRING - Nome de quem irá receber a mensagem
	 * @param $emailParaResposta- STRING - E-mail que está enviando a mensagem, que deverá receber a resposta da mensagem
	 * @param $nomeParaResposta	- STRING - Nome de quem mandou a mensagem e receberá a resposta
	 * @param $assunto			- STRING - Assunto do Email
	 * @param $mensagen			- STRING - Corpo do Email
	 * @return void
	 */	
	 
	public function enviar($emailParaResposta,$nomeParaResposta,$mensagem,$assunto="ASSUNTO",$emailPara='seu@email.com.br',$nomePara="Seu Nome"){
		
		//configurar o e-mail de resposta (ReplyTo)
		$this->mailer->AddReplyTo($emailParaResposta,$nomeParaResposta);
		
		//configurar o e-mail que está enviando a mensagem (To)
		$this->mailer->AddAddress($emailPara,$nomePara);
		
		//assunto		
		$this->mailer->Subject    = $assunto;
		
		//texto alternativo, caso o leitor de e-mail não suporte html
		$this->mailer->AltBody    = "Para ver a mensagem, por favor use um visualizador de e-mail compatível com HTML!"; // optional, comment out and test
		
		// mensagem em HTML
		$this->mailer->MsgHTML($mensagem);
		
		//realizar o envio
		$resultado = $this->mailer->Send();
		//limpar os campos de remententes e anexos
		$this->mailer->ClearAddresses();
		$this->mailer->ClearAllRecipients();
		$this->mailer->ClearReplyTos();
		$this->mailer->ClearAttachments();
		return $resultado;					
	}
	// FECHA METODO DE ENVIO 
	


}//fecha a classe
?>