<?php
    include("util_functions.php");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    if ( isset( $_POST ) ){
        $nome = $_POST["nome_material"];
        $preco = $_POST["preco"];
        $quantidade = $_POST["quantidade"];
        $stock = $_POST["stock"];
        $image = &_POST["image"];
        echo $nome;
        echo $preco;
        echo $quantidade;
        echo $stock;
        echo $image;
        createMaterial($conn, $nomw, $preco, $quantidade, $stock,$imagem,true);
    }