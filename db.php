<?php
    try{
        $connection = new PDO('mysql:host=localhost;dbname=parintinsexplore', 'root', '');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Erro: ".$e->getMessage();
    }

?>