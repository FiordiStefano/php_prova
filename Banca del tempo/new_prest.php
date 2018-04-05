<?php
  session_start();

  try {
	  $conn = new PDO("mysql:host=localhost;dbname=BancaTempo", "root", "root");
	} catch (PDOexception $e) {
		echo $e->getMessage();
	}
  $cats = $conn->query("SELECT * FROM categoria");
	$users = $conn->query("SELECT * FROM socio");
  $display = "block";
  $display_done = "none";
  if(isset($_POST["btn_reg"])) {
    $nome = test_input($_POST["nome"]);
    $cognome = test_input($_POST["cognome"]);
    $telefono = test_input($_POST["telefono"]);
    $indirizzo = test_input($_POST["indirizzo"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $idzona = test_input($_POST["zona"]);
    
    $insert = $conn->prepare("INSERT INTO socio (nome, cognome, telefono, indirizzo, email, password, idZona) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if($insert->execute([$nome, $cognome, $telefono, $indirizzo, $email, $password, $idzona])) {
      $display = "none";
      $display_done = "block";
      $_SESSION["login_email"] = $email;
      $done = "<h1>Registrazione</h1><h1>completata</h1><h1>con successo</h1>";
      header("refresh:3; url=home.php");
    } else {
      $display = "none";
      $display_done = "block";
      $done = "<h1>Errore nella</h1><h1>registrazione</h1>";
      header("refresh:3");
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Banca del tempo registrazione</title>
    <style>
      body {
        color: white;
        background-color: #334a78;
        font-family: verdana, thin;
      }
      .modulo {
        position: absolute;
        top: 35%;
        left: 45%;
        padding-left: 5%;
        padding-right: 5%;
        margin: -150px 0 0 -150px;
        background-color: white;
        color: black;
        text-align: center;
      }
      .reg {
        margin-top: 16px;
        float: right;
        margin-right: 24px;
      }
      .title {
        display: inline-block;
        margin-left: 24px;
      }
      a:link, a:visited {
        background-color: #8592DD;
        color: white;
        padding: 14px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
      }
      a:hover, a:active, input[type=submit]:hover, input[type=submit]:active {
          background-color: #6F7FDD;
      }
      .reg_form {
        margin-bottom: 16px;
        width: 75%;
        padding: 5%;
      }
			#req, #cat, #erog {
				width: 85%;
			}
      #title:hover, #title:active, #title:link, #title:visited {
        background-color: #334a78;
        padding: 0px;
      }
      input[type=submit] {
        background-color: #8592DD;
        color: white;
        border: none;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 24px;
      }
    </style>
  </head>
  <body>
    <div class="title">
      <a href="home.php" id="title"><h1 style="font-size:50px">BANCA DEL TEMPO</h1></a>
    </div>
    <div class="reg">
      <a href="sign_in.php"><h2>Accedi</h2></a>
    </div>
    <div class="modulo" style="display:<?php echo $display; ?>;">
      <h1>Prestazione</h1>
      <form action="" method="post">
        <input type="text" required="required" placeholder="Prestazione" class="reg_form" name="prest"><br>
        <input type="date" required="required" class="reg_form" name="data"><br>
        <input type="date" required="required" class="reg_form" name="data_richiesta"><br>
        <input type="text" required="required" placeholder="Tempo" class="reg_form" name="tempo"><br>
				<label><strong>Erogante: </strong></label><br>  
        <select id="erog" class="reg_form" name="erogante">
          <?php 
            while($row = $users->fetch()) {
              echo "<option value=\"".$row["idSocio"]."\">".$row["email"]."</option> \n";
            }
          ?>
        </select><br>
				<label><strong>Richiedente: </strong></label><br>  
        <select id="req" class="reg_form" name="richiedente">
          <?php 
						$users = $conn->query("SELECT * FROM socio");
            while($row = $users->fetch()) {
              echo "<option value=\"".$row["idSocio"]."\">".$row["email"]."</option> \n";
            }
          ?>
        </select><br>
        <label><strong>Categoria: </strong></label><br>  
        <select id="cat" class="reg_form" name="cat">
          <?php 
            while($row = $cats->fetch()) {
              echo "<option value=\"".$row["idCategoria"]."\">".$row["nomeCategoria"]."</option> \n";
            }
          ?>
        </select><br>
        <input type="submit" class="reg_form" name="btn_reg" value="Conferma"> 
      </form>
    </div>
    <div class="modulo" style="display:<?php echo $display_done; ?>;">
      <?php echo $done; ?>
    </div>
  </body>
</html>