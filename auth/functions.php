<?php

require_once 'cadastro.php';
	
	/**
    * Responsável por persistir dados entre view e controller
    * @param object $class, string $acao, int $id
    * @return void
    */
	function executar($class, $acao)
	{
		if  ($acao == 'salvar') 
		{	
			$data = $class->salvar();
		}
	}

	
	if (isset($_POST) && !empty($_POST) && isset($_GET['acao']))
	{	
		executar($class, $_GET['acao']);
	} 
	
