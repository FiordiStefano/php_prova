<?php
	session_start();
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
				$_SESSION["login_email"] = $em;
        header("Location:../Registrazione/benvenuto.php");
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
<!DOCTYPE html>
<html>
  <head>
    <style>
      .login
      {
        position: absolute;
        width: 16%;
        left: 42%;
        background-color: #0099ff;
        border-radius: 1% 1%;
        padding: 1%;
        color: white;
        font-family: Verdana, sans-serif;
        text-align: right;
      }
      h2
      {
        text-align: center;
      }
      a
      {
        color: white;
        margin-right: 5%;
      }
      .formLogin
      {
          width: 60%;
          margin-bottom: 5%;
      }
      label
      {
        margin-right: 5%;
      }
      button
      {
        background-color: #ff5500;
        border: none;
        border-radius: 8px;
        color: white;
        padding: 10px 20px;
        margin: 4px 2px;
        cursor: pointer;
      }
      button:active
      {
        background-color: #ffaa00;
      }
    </style>
  </head>
  <body>
    <div class="login">
	    <h2>Login</h2>
      <form action="" method="post">
        <?php if(isset($error)) { echo "<p style=\"color:white;text-align:center;\">".$error."</p>"; } ?>
    	  <label>E-mail: </label><input type="text" class="formLogin" name="em" required="required" />
        <label>Password: </label><input type="password" class="formLogin" name="p" required="required" />
        <a href="registrazione.php" class="signup">Registrati</a>
        <button type="submit" name="loginButton">Accedi</button>
      </form>
    </div>
  </body>
</html>