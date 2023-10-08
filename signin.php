<?php

	include 'db.php';

	try {

		$json = file_get_contents('php://input');
	    $obj = json_decode($json,true);

	    $nomeUsuario = $obj['nomeUsuario'];
	    $senha = $obj['senha'];

	    $statement_login = $connection->prepare("SELECT * FROM cadastro WHERE nome_usuario = :nomeUsuarioGet AND senha = :senhaGet");
	    $statement_login->bindParam(':nomeUsuarioGet', $nomeUsuario);
	    $statement_login->bindParam(':senhaGet', $senha);

	    $statement_login->execute();

	    if ($statement_login->rowCount() > 0) {
	        echo "Sucessfull";
	    } else {
	        echo "Error";
	    }
	} catch (PDOException $e) {
	    echo "FatalError: " . $e->getMessage();
	}
?>
