<!DOCTYPE html>
	<html>
		<head>
			<title>AdicionarItem</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="add_ferramentas.css">
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
            // Check connection
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST)) {
                    $nome = $_POST["nome_ferramenta"];
                    $sala = $_POST["nome_sala"];
                    $id = createFerramenta($conn, $nome, $sala);
                    header("Location:add_slots.php?tool_id=$id");
                }
            }
            elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
                if (isset($_GET["tool_id"])) {
                    $tool_id = $_GET["tool_id"];
                    $ferramenta = getFerramenta($conn, $tool_id);
                    $nome = $ferramenta["nome"];
                    $sala = $ferramenta["sala"];
                }
                else{
                    $tool_id = -1;
                    $nome = "";
                    $sala = "";
                }
            }
        ?>

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
                               <h1>Adicionar ferramenta</h1>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 offset-lg-1 offset-xl-1">

                            <img class="img-responsive" id="material" alt="imagem" src="img/49380234_2183080501714769_5785045498574405632_o.jpg">
                            
                        </div>

                            <form id="myForm" action="add_ferramentas.php" method="POST">
                                <div class=" col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 ">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
                                                       <input id="nome" name="nome_ferramenta" type="text" placeholder="Nome"
                                                          value="<?php echo $nome?>"
                                                       >
                                                       <input id="nomeSala" name="nome_sala" type="text" placeholder="Sala"
                                                          value="<?php echo $sala?>"
                                                       >
                                                    </div>

                                                </div>
                                            </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 ">
                                            <div>

                                            <div id="slots">
                                                <h2>Slots</h2>

                                            </div>

                                                <?php
                                                    $slots = getFerramentaSlots($conn, $tool_id);
                                                    if(sizeof($slots) == 0){
                                                        echo "Não existem slots...";
                                                    }
                                                    else {
                                                        echo "<table class='table'>
        <thead>
          <tr>
            <th>Hora inicio</th>
            <th>Hora fim</th>
          </tr>
        </thead>
        <tbody>";
                                                        foreach ($slots as $slot) {
                                                            echo "<tr>";
                                                            echo "<td>" . $slot["inico_slot"] . "</td>";
                                                            echo "<td>" . $slot["fim_slot"] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                        echo "
        </tbody>
      </table>";
                                                    }

                                                ?>
<!--                                            <div id="horas">-->
<!--                                                Hora de começo<input id="horacomeco" name="horacomeco" type="text">-->
<!---->
<!--                                                Hora de fim<input id="horafim" name="horafim" type="text">-->
<!---->
<!--                                            </div>-->

                                        </div>
                                            <input id="confirmar" name="submit" value="Confirmar" type="submit">

                                            <a id="voltar" href="#">Voltar</a>

                                        </div>
                            </form>
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
            </script>
		</body>
	</html>