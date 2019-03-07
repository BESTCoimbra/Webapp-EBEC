<!DOCTYPE html>
	<html>
		<head>
			<title>AdicionarSlot</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="add_slots.css">
			<meta charset="utf-8">
            
            <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
            


			<script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>



		</head>

		<body>
        <?php
            include("back-end/util_functions.php");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }


        ?>
        <script>
            function changeTool() {
                let tool_id = document.getElementById("dropdown_ferramentas").value;

                $.ajax({
                    method: "GET", url: "back-end/tool_slots.php?tool_id=" + tool_id,
                }).done(function( data ) {
                    var result = $.parseJSON(data);
                    if (result.length === 0){
                        $("#horas").html("<p>Não existem slots disponiveis</p>");
                        return;
                    }
                    var string = '<table><tr><th>Inicio</th><th>Fim</th><th>Ocupado</th></tr>';

                    //from result create a string of data and append to the div
                    $.each( result, function( key, value ) {

                        string += "<tr>" +
                            "<td>"+value['inico_slot'] + "</td>" +
                            "<td> " + value['fim_slot']+"</td>"+
                            "<td> " + value['ocupado']+"</td>"+
                        "</tr>";
                    });
                    string += '</table>';
                    $("#horas").html(string);
                });
                document.getElementById("form_tool_id").value = tool_id;
            }
        </script>
			<header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                        <div id="imagemHeader">

                            <img class="img-responsive" src="img/EBEC_Local_short_name.png" >
                            </div>
                        </div>
                    </div>
				</div>
			</header>

			<main>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                             
                            <h1>Adicionar Slot</h1>
                             
                        </div>
                           
                    </div>
                        
                        <div class="col-12">
                            
                           
                            <div id="ferramenta">
                                
                                <p1>Ferramenta</p1>
                                <?php
                                    $ferramentas = getAllFerramentas($conn);
                                    if(sizeof($ferramentas) == 0){
                                        echo "<p> Não existem ferramentas...</p>";
                                    }
                                    else{
                                        echo "<select id='dropdown_ferramentas' onchange='changeTool();'>";
                                        foreach ($ferramentas as $ferramenta){
                                            echo "<option value='" . $ferramenta['id'] ."'>" . $ferramenta['nome'] . "</option>";
                                        }
                                        echo "</select>";
                                    }
                                ?>
                                
                            </div>

                            <div id="horas">
                            </div>
                            <form action="back-end/add_slot.php" method="POST">
                                <input id="form_tool_id" name="ferramenta_id" type="hidden" value="3">
                                <input name="timestamp_inicio" id="inicio" type="datetime-local">
                                <input name="timestamp_fim" id="fim" type="datetime-local">
                                <input type="submit" value="+">
                            </form>

                            <a id="voltar" href="homepage_editor.php">Voltar</a>
                               
                    </div> 
                </div>
                            
                
			</main>
            <script>
                var n=0;
                function Add(){
                    n++;
                    $("#numero").text(n.toString());
                }
                function Less(){
                    if(n>0){
                        n--;
                        $("#numero").text(n.toString());
                    }
                }
                changeTool();
            </script>
		</body>
	</html>