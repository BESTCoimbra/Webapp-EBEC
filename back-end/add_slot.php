<?php
    include("util_functions.php");
    if(isset($_POST)) {
        echo $_POST["form_tool_id"];
        $tool_id = $_POST["ferramenta_id"];
        $timestamp_inicio = $_POST["timestamp_inicio"];
        $timestamp_fim = $_POST["timestamp_fim"];
        $slot = createSlot($conn, $tool_id,
            strtotime($timestamp_inicio),
            strtotime($timestamp_fim)
        );
        echo json_encode($slot);
        header("Location:../add_slots.php");
    }

?>