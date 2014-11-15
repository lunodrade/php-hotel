<?php

    require_once '../constantes.php';

    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$OK = true; // We use this to verify the status of the update.
	// If 'buscar' is in the array $_POST proceed to make the query.
	if (isset($_GET['email'])) {
		// Create the query
		$data = $_GET['email'];
		$sql = 'SELECT usu_email FROM tb_usuarios WHERE usu_email = ?';
		// we have to tell the PDO that we are going to send values to the query
		$stmt = $conn->prepare($sql);
		// Now we execute the query passing an array toe execute();
		$results = $stmt->execute(array($data));
		// Extract the values from $result
		$rows = $stmt->fetchAll();
		$error = $stmt->errorInfo();
	}
	// If there are no records.
	if(empty($rows)) {
		echo "<p>Disponivel</p>";
	}
	else {
		echo "<p>Nao disponivel, tente outro email</p>";
	}
?>