<?php
	session_start();
  if(isset($_POST["btn_login"])) {
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $result;
    $error;
    try {
			$conn = new PDO("mysql:host=localhost;dbname=BancaTempo", "root", "root");
		} catch (PDOexception $e) {
			echo $e->getMessage();
		}
    $sql = $conn->prepare("SELECT email, password FROM socio WHERE email=? AND password=?");
		$sql->execute([$email, $password]);
    if ($sql->rowCount() == 0) {
      $error = "E-mail o password errati";
    } else {
		  $_SESSION["login_email"] = $email;
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
    <title>Banca del tempo accesso</title>
    <style>
      body {
        color: white;
        background-color: #334a78;
        font-family: verdana, thin;
        text-align: center;
      }
      .login {
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
        float: left;
        margin-left: 24px;
      }
      .login_form {
        margin-bottom: 16px;
        width: 90%;
        padding: 5%;
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
        padding: 8px;
      }
    </style>
  </head>
  <body>
    <div class="title">
      <a href="home.php" id="title"><h1 style="font-size:50px">BANCA DEL TEMPO</h1></a>
    </div>
    <div class="reg">
      <a href="sign_up.php"><h2>Registrati</h2></a>
    </div>
    <div class="login">
	    <h1>Login</h1>
      <form action="" method="post">
        <?php if(isset($error)) { echo "<p>".$error."</p>"; } ?>
    	  <input type="text" placeholder="E-mail" class="login_form" name="email" required="required" /><br>
        <input type="password" placeholder="Password" class="login_form" name="password" required="required" /><br>
        <input type="submit" name="btn_login" value="Accedi">
      </form>
    </div>
  </body>
</html>