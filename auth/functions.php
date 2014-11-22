<?php

require_once 'cadastro.php';
	
	/**
    * Responsável por persistir dados entre view e controller
    * @param object $class, string $acao, int $id
    * @return void
    */
	function executar($class, $acao, $id)
	{
		if  ($acao == 'salvar') 
		{	
			$data = $class->salvar();
		}
	}

	if (!isset($_GET['id']) ? $_GET['id'] = '' : '');

	if (isset($_POST) && !empty($_POST) && isset($_GET['acao']))
	{	
		executar($class, $_GET['acao'], $_GET['id']);
	} 
	elseif (isset($_GET) && !empty($_GET) && isset($_GET['acao'])) 
	{
		executar($class, $_GET['acao'], $_GET['id']);
	}
