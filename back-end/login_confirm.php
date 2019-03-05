<?php
    include("util_functions.php");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    if ( isset( $_POST ) ){
        $username = $_POST["username"];
        $password = $_POST["password"];

        attemptLogin($conn, $username, $password);
    }

?>