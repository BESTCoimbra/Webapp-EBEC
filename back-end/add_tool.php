<?php
    include("util_functions.php");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    if ( isset( $_POST ) ){
        $nome = $_POST["nome_ferramenta"];
        $sala = $_POST["nome_sala"];
        echo $nome;
        echo $sala;
        createFerramenta($conn, $nome, $sala);
    }