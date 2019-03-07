<?php
    $db = [
        "hostname" => "sql2.freemysqlhosting.net",
        "database" => "sql2280943",
        "username" => "sql2280943",
        "password" => "mK6!mU3!",
        "port" => "3306"
    ];


    function connectToDatabase($hostname, $database, $username, $password, $port){
        $conn = new mysqli($hostname, $username,
            $password, $database, $port);
        return $conn;
    }

    /* User functions */

    function attemptLogin($connection, $username, $password){
        $stmt = $connection->prepare("SELECT * FROM Equipas WHERE nome = ? AND password = ?;");
        $stmt->bind_param("ss", $username, $password);

        if (!$stmt->execute()) {
            //TODO add logging file
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!($res = $stmt->get_result())) {
            echo "Getting result set failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if( $res->num_rows == 0){
            echo '<div class="alert alert-danger" role="alert">
                Username or Password are incorrect!
            </div>';
        }
        else {
            echo "Welcome $username";
            $row = mysqli_fetch_assoc($res);
            if($row["admin"]){
                header("Location:homepage_editor.php");
            }
            else{
                header("Location:userArea.html");
            }
        }
    }


    /* Ferramentas */

    function createFerramenta($connection, $nome, $sala){
        $stmt = $connection->prepare("Insert INTO Ferramentas(nome, sala) VALUES(?,?);");

        $stmt->bind_param("ss", $nome, $sala);

        if (!$stmt->execute()) {
            //TODO add logging file
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        return $connection->insert_id;
    }

    function getFerramentaSlots($connection, $ferramenta_id){
        $result = $connection->query("SELECT * FROM Slots WHERE ferramenta_id = $ferramenta_id");
        $slots = array();
        if ($result->num_rows != 0){
            while($row = $result->fetch_assoc()) {
                $slots[] = $row;
            }
        }
        return $slots;
    }

    function createSlot($connection, $ferramenta_id, $timestamp_inicio, $timestamp_fim){
        $stmt = $connection->prepare("Insert INTO Slots(ferramenta_id, inico_slot, fim_slot) VALUES(?,FROM_UNIXTIME(?),FROM_UNIXTIME(?));");

        $stmt->bind_param("iii", $ferramenta_id, $timestamp_inicio, $timestamp_fim);

        if (!$stmt->execute()) {
            //TODO add logging file
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        return $connection->insert_id;
    }

    function getFerramenta($connection, $ferramenta_id){
        $result = $connection->query("SELECT * FROM Ferramentas WHERE id = $ferramenta_id");
        return mysqli_fetch_assoc($result);
    }

    function getAllFerramentas($connection){
        $result = $connection->query("SELECT * FROM Ferramentas");
        $ferramentas = array();
        if ($result->num_rows != 0){
            while($row = $result->fetch_assoc()) {
                $ferramentas[] = $row;
            }
        }
        return $ferramentas;
    }

    /* Team */

    function createEquipa($connection, $nome, $password, $creditos, $is_admin, $sala){
        $stmt = $connection->prepare("Insert INTO Equipas(nome, password, creditos, admin, sala) VALUES(?,?,?,?, ?);");

        $stmt->bind_param("ssdis", $nome, $password, $creditos, $is_admin, $sala);

        if (!$stmt->execute()) {
            //TODO add logging file
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        $id = $connection->insert_id;
        return $id;
    }

    function getAllEquipas($connection){
        $result = $connection->query("SELECT * FROM Equipas");
        $equipas = array();
        if ($result->num_rows != 0){
            while($row = $result->fetch_assoc()) {
                $equipas[] = $row;
            }
        }
        return $equipas;
    }

function createPessoa($connection, $nome, $curso, $team_id){
    $stmt = $connection->prepare("Insert INTO Pessoas(nome, curso, equipe_id) VALUES(?,?,?);");

    $stmt->bind_param("ssi", $nome, $curso, $team_id);

    if (!$stmt->execute()) {
        //TODO add logging file
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $id = $connection->insert_id;
    return $id;
}

    // Create connection
    $conn = connectToDatabase($db["hostname"],  $db["database"], $db["username"],
        $db["password"],$db["port"]);
