<?php
    include("util_functions.php");
    if(isset($_GET)) {
        $tool_id = $_GET["tool_id"];
        $slots = getFerramentaSlots($conn, $tool_id);
        echo json_encode($slots);
    }
    else{
        echo json_encode(array());
    }
    ?>