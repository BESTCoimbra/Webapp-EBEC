<!DOCTYPE html>
	<html>
		<head>
			<title>HomepageEditor</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="edit_teams.css">
			<meta charset="utf-8">
            
            <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
            
			
				
			<script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>



		</head>

		<body>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                include("back-end/util_functions.php");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if ( isset( $_POST ) ){
                    $username = $_POST["nome_equipa"];
                    $password = $_POST["password"];
                    $is_admin = !empty($_POST["is_admin"]);
                    $creditos = $_POST["creditos"];
                    $sala = $_POST["nome_sala"];

                    $team_id = createEquipa($conn, $username, $password, $creditos, $is_admin, $sala);

                    $nome_membro_1 = $_POST["nome_membro_1"];
                    $nome_membro_2 = $_POST["nome_membro_2"];
                    $nome_membro_3 = $_POST["nome_membro_3"];
                    $nome_membro_4 = $_POST["nome_membro_4"];

                    $curso_membro_1 = $_POST["curso_membro_1"];
                    $curso_membro_2 = $_POST["curso_membro_2"];
                    $curso_membro_3 = $_POST["curso_membro_3"];
                    $curso_membro_4 = $_POST["curso_membro_4"];

                    if($nome_membro_1 != "" && $curso_membro_1 != "") {
                        createPessoa($conn, $nome_membro_1, $curso_membro_1, $team_id);
                    }
                    if($nome_membro_2 != "" && $curso_membro_2 != "") {
                        createPessoa($conn, $nome_membro_2, $curso_membro_2, $team_id);
                    }
                    if($nome_membro_3 != "" && $curso_membro_3 != "") {
                        createPessoa($conn, $nome_membro_3, $curso_membro_3, $team_id);
                    }
                    if($nome_membro_4 != "" && $curso_membro_4 != "") {
                        createPessoa($conn, $nome_membro_4, $curso_membro_4, $team_id);
                    }
                    header("Location:homepage_editor.php");
                }
                else{
                    $username = "";
                    $password = "";
                    $is_admin = "";
                    $creditos = 0;
                    $sala = "";
                    $nome_membro_1 = "";
                    $nome_membro_2 = "";
                    $nome_membro_3 = "";
                    $nome_membro_4 = "";
                    $curso_membro_1 = "";
                    $curso_membro_2 = "";
                    $curso_membro_3 = "";
                    $curso_membro_4 = "";
                }
            }
            else{
                $username = "";
                $password = "";
                $is_admin = "";
                $creditos = 0;
                $sala = "";
                $nome_membro_1 = "";
                $nome_membro_2 = "";
                $nome_membro_3 = "";
                $nome_membro_4 = "";
                $curso_membro_1 = "";
                $curso_membro_2 = "";
                $curso_membro_3 = "";
                $curso_membro_4 = "";
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
                <form action="edit_teams.php" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <h1>Adicionar equipa</h1>
                            </div>
                        </div>
                        <div class="container">
                             <div class="row">
                                 <div class="col-6">
                                     <input id="nome_equipa" name="nome_equipa" type="text" placeholder="Username"
                                        value="<?php echo $username?>"
                                     >
                                     <br>
                                     <input id="nome_membro_1" name="nome_membro_1" type="text" placeholder="Nome Membro 1">
                                     <input id="nome_membro_2" name="nome_membro_2" type="text" placeholder="Nome Membro 2">
                                     <input id="nome_membro_3" name="nome_membro_3" type="text" placeholder="Nome Membro 3">
                                     <input id="nome_membro_4" name="nome_membro_4" type="text" placeholder="Nome Membro 4">
                                     <br>
                                     <input id="nome_sala" name="nome_sala" type="text" placeholder="Sala">
                                     <input id="creditos" name="creditos" type="number" placeholder="Creditos">
                                 </div>
                                 <div class="col-6">
                                     <input id="password" name="password" type="text" placeholder="Password">
                                     <br>
                                     <input id="curso_membro_1" name="curso_membro_1" type="text" placeholder="Curso Membro 1">
                                     <input id="curso_membro_2" name="curso_membro_2" type="text" placeholder="Curso Membro 2">
                                     <input id="curso_membro_3" name="curso_membro_3" type="text" placeholder="Curso Membro 3">
                                     <input id="curso_membro_4" name="curso_membro_4" type="text" placeholder="Curso Membro 4">
                                     <p style="display: inline">Admin:</p>
                                     <input id="is_admin" type="checkbox" name="is_admin">
                                 </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <input id="confirmar" type="submit" value="Confirmar" name="submit">
                                <a id="voltar" href="homepage_editor.php">Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </body>