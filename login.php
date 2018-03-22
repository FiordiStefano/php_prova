<!DOCTYPE html>
<?php
  if(isset($_POST["loginButton"])) {
    $em = test_input($_POST["em"]);
    $p = test_input($_POST["p"]);
    $result;
    $error;
    try {
      conn();
      $sql = "SELECT Email, Password FROM utenti WHERE Email='$em' AND Password='$p'";
      if (mysql_num_rows(mysql_query($sql)) == 0) {
        $error = "E-mail o password errati";
      }
      else {
        header("Location:benvenuto.php");
        exit();
      }
    } catch(Exception $e) {
      $result = "Errore";
    }
  }

  function conn() {
    mysql_connect("localhost", "root", "root") or die ("Impossibile connettersi al server: " . mysql_error());
    mysql_select_db("php_web") or die ("Accesso al db non riuscito: " . mysql_error());
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="title">
    <img class="logo" alt="logo" src="hourglass.png">
    <h1> TIME BANK</h1>
  </div>
  <div class="login">
	<h1>Login</h1>
      <form action="" method="post">
    	  <input type="text" name="em" placeholder="E-mail" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <?php if(isset($error)) { echo "<p style=\"color:white;text-align:center;\">".$error."</p>"; } ?>
        <button type="submit" class="btn btn-primary btn-block btn-large" name="loginButton">Accedi</button>
        <a href="registrazione.php" class="signup"> Registrati </a>
      </form>
    </div>
  </body>
</html>
