<?php
  session_start();

  try {
	  $conn = new PDO("mysql:host=localhost;dbname=BancaTempo", "root", "root");
	} catch (PDOexception $e) {
		echo $e->getMessage();
	}
  ses_check($conn);

  $display = "block";
  $display_done = "none";
  if(isset($_POST["btn_reg"])) {
    $cat = test_input($_POST["cat"]);
    
    $insert = $conn->prepare("INSERT INTO categoria (nomeCategoria) VALUES (?)");
    if($insert->execute([$cat])) {
      $display = "none";
      $display_done = "block";
      $done = "<h1>Categoria</h1><h1>inserita</h1><h1>con successo</h1>";
      header("refresh:3; url=home.php");
    } else {
      $display = "none";
      $display_done = "block";
      $done = "<h1>Errore nell'</h1><h1>inserimento</h1>";
      header("refresh:3");
    }
  }
  
  function ses_check($conn) {
    $user_check = $_SESSION["login_email"];
    $ses_sql = $conn->prepare("SELECT email FROM socio WHERE email=?");
    $ses_sql->execute([$user_check]);
    $row = $ses_sql->fetch();
    $login_session = $row["email"];
    if(!isset($login_session)) {
      logout();
    }
  }
  
  function logout() {
    if(session_destroy()) {
      header("Location:home.php");
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
    <title>Banca del tempo - Nuova Categoria</title>
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
    <div class="modulo" style="display:<?php echo $display; ?>;">
      <h1>Categoria</h1>
      <form action="" method="post">
        <input type="text" required="required" placeholder="Nome categoria" class="reg_form" name="cat"><br>
        <input type="submit" class="reg_form" name="btn_reg" value="Conferma"> 
      </form>
    </div>
    <div class="modulo" style="display:<?php echo $display_done; ?>;">
      <?php echo $done; ?>
    </div>
  </body>
</html>