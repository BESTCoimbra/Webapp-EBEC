<!DOCTYPE html>
	<html>
		<head>
			<title>HomepageEditor</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="homepage_editor.css">
			<meta charset="utf-8">
            
            <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
            
			
				
			<script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>



		</head>

		<body>
            <?php
                include("back-end/util_functions.php");

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
                             
                            <h1>Lista de Equipa</h1>
                            
                             
                        </div>
                        <div class="container">
                         <div class="row">
                            <div class="col-8">
                           
                                <div class="equipa">
                                    <?php
                                        $equipas = getAllEquipas($conn);
                                        if(sizeof($equipas) == 0){
                                            echo "Não existem equipas...";
                                        }
                                        else {
                                            echo "<table class='table'>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Creditos</th>
        <th>Sala</th>
      </tr>
    </thead>
    <tbody>";
                                            foreach ($equipas as $equipa) {
                                                echo "<tr>";
                                                echo "<td>" . $equipa["nome"] . "</td>";
                                                echo "<td>" . $equipa["creditos"] . "</td>";
                                                echo "<td>" . $equipa["sala"] . "</td>";
                                                echo "</tr>";
                                            }
                                            echo "
    </tbody>
  </table>";
                                        }
                                    ?>
                                </div>
                            </div>
                               
                            <div class="col-4">
                             <div id="btns">
                                 <form action="">
                                    <input id="devolvercompra" value="Devolver compra" type="submit" name="submit">
                                 </form>

                                 <form action="edit_teams.php" method="GET">
                                    <input id="devolvercompra" value="Adicionar equipa" type="submit" name="submit">
                                 </form>
                            </div>
                           </div>
                            
                        </div>
                           
                         </div>
                    </div>
                </div>
                 <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                           <div class="listadeitems">     
                                <h1>Lista de Items</h1>
                            </div>
                           
                        </div>
                        
                         <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    <img class="img-responsive" id="material" src="img/49380234_2183080501714769_5785045498574405632_o.jpg">
                                </div>
                                <div class="col-2">
                                    <p>Preço</p>
                                     <input id="nome" type="text"> 
                                </div>
                                <div class="col-2">
                                    <p>Stock</p>
                                    <a id="menos" onclick="Less()">-</a>
                                                <label id="numero">0</label>
                                                <a id="mais" onclick="Add()">+</a>
                                </div>
                                <div class="col-2">
                                    <label id="x">X</label>
                                </div>
                                <div class="col-4">
                                     <input id="devolvercompra" value="Adicionar item" name="submit">
                                </div>
                             </div>
                        </div>
                     </div>
                </div>
                
                 <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                           <div class="listadeitems">     
                                <h1>Lista de ferramentas</h1>
                            </div>
                        </div>
                        
                           <div class="container">
                         <div class="row">
                            <div class="col-2">
                                <img class="img-responsive" id="img" src="img/49380234_2183080501714769_5785045498574405632_o.jpg">
                            </div>
                             
                             <div class="col-4">
                                    <p>ferramenta 1</p>
                            </div>
                             
                             <div class="col-2">
                                <label id="x2">X</label>
                            </div>
                               
                            <div class="col-4">
                             <div id="btns">
                                <input id="adicionarferramenta" value="Adicionar ferramenta" name="submit">

                                <input id="devolvercompra" value="Adicionar slot" name="submit">
                            </div>
                           </div>
                            
                        </div>
                           
                         </div>
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