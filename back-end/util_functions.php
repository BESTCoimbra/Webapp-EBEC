<?php
$db = [
    "hostname" => "sql2.freemysqlhosting.net",
    "database" => "sql2280943",
    "username" => "sql2280943",
    "password" => "mK6!mU3!",
    "port" => "3306"
];


function connectToDatabase($hostname, $database, $username, $password, $port)
{
    $conn = new mysqli($hostname, $username,
        $password, $database, $port);
    return $conn;
}

/* User functions */

function attemptLogin($connection, $username, $password)
{
    $stmt = $connection->prepare("SELECT * FROM Equipas WHERE nome = ? AND password = ?;");
    $stmt->bind_param("ss", $username, $password);

    if (!$stmt->execute()) {
        //TODO add logging file
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!($res = $stmt->get_result())) {
        echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if ($res->num_rows == 0) {
        echo "User or password is incorrect";
        echo "<script> location.href='../index.html'; </script>";
    } else {
        echo "Welcome $username";
        echo "<script> location.href='../add_ferramentas.html'; </script>";
    }
}


/* Ferramentas */

function createFerramenta($connection, $nome, $sala, $got_to_details)
{
    $stmt = $connection->prepare("Insert INTO Ferramentas(nome, sala) VALUES(?,?);");

    $stmt->bind_param("ss", $nome, $sala);

    if (!$stmt->execute()) {
        //TODO add logging file
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $id = $connection->insert_id;

    if ($got_to_details) {
        echo "Go to details of " . $id;
    } else {
        echo "Tool added: " . $id;
    }
}

function createMaterial($connection, $Nome_Material, $Preco, $Quantidade_stock, $Existe_stock,$imagem_URL, $got_to_details)
{
    $stmt = $connection->prepare("INSERT INTO materiais (Nome_Material, Preco, Quantidade_stock, Existe_stock, imagem_URL) VALUES (?,?,?,?,?);");

    $stmt->bind_param("ss", $Nome_Material, $Preco, $Quantidade_stock, $Existe_stock, $imagem_URL);

    if (!$stmt->execute()) {
        //TODO add logging file
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $id = $connection->insert_id;

    if ($got_to_details) {
        echo "Go to details of " . $id;
    } else {
        echo "Material added: " . $id;
    }
}

// Create connection
$conn = connectToDatabase($db["hostname"], $db["database"], $db["username"],
    $db["password"], $db["port"]);
