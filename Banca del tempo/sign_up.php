<?php
  session_start();

  try {
	  $conn = new PDO("mysql:host=localhost;dbname=BancaTempo", "root", "root");
	} catch (PDOexception $e) {
		echo $e->getMessage();
	}
  $zona = $conn->query("SELECT * FROM zona");
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
		<meta charset="UTF-8">
    <title>Banca del tempo - Registrazione</title>
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
      #zona {
        width: 58%;
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
      <h1>Registrazione</h1>
      <form action="" method="post">
        <input type="text" required="required" placeholder="Nome" class="reg_form" name="nome"><br>
        <input type="text" required="required" placeholder="Cognome" class="reg_form" name="cognome"><br>
        <input type="text" required="required" placeholder="Telefono" class="reg_form" name="telefono"><br>
        <input type="text" required="required" placeholder="Indirizzo" class="reg_form" name="indirizzo"><br>
        <input type="text" required="required" placeholder="E-mail" class="reg_form" name="email"><br>
        <input type="password" required="required" placeholder="Password" class="reg_form" name="password"><br>
        <label><strong>Zona: </strong></label>  
        <select id="zona" class="reg_form" name="zona">
          <?php 
            while($row = $zona->fetch()) {
              echo "<option value=\"".$row["idZona"]."\">".$row["nomeZona"]."</option> \n";
            }
          ?>
        </select><br>
        <input type="submit" class="reg_form" name="btn_reg" value="Registrati"> 
      </form>
    </div>
    <div class="modulo" style="display:<?php echo $display_done; ?>;">
      <?php echo $done; ?>
    </div>
  </body>
</html>