<!DOCTYPE html>
 <?php  
  session_start();
  if(isset($_POST["exit"])) {
    logout();
  }
  if(isset($_POST["regButton"])) {
    $nome = test_input($_POST["nome"]);
    $email = test_input($_POST["email"]);
    $cognome = test_input($_POST["cognome"]);
    $password = test_input($_POST["password"]);
    $nazionalita = test_input($_POST["nazionalita"]);
    $sesso = test_input($_POST["sesso"]);
    $password = test_input($_POST["password"]);
    $patente = "";
    if(isset($_POST["patenteA"]) && isset($_POST["patenteA"])) {
      $patente = test_input($_POST["patenteA"]) . test_input($_POST["patenteB"]);
    }
    else if(isset($_POST["patenteA"])) {
      $patente = test_input($_POST["patenteA"]);
    }
    else if(isset($_POST["patenteB"])) {
      $patente = test_input($_POST["patenteB"]);
    }
    
    $result;
    try {
      conn();
      $sql = "INSERT INTO utenti (Cognome, Nome, Sesso, Nazionalita, Patente, Email, Password) VALUES ('$cognome', '$nome', '$sesso', '$nazionalita', '$patente', '$email', '$password')";
      if (mysql_query($sql)) {
        $_SESSION["login_email"] = $email;
        $result = "<div id=\"esito\"><h2>Esito registrazione</h2><h3> Utente registrato correttamente </h3><form action=\"\" method=\"post\"><button type=\"submit\" name=\"exit\">Esci</button><form><</div>";
      }
      else {
        $result = "<div id=\"esito\"><h2>Esito registrazione</h2><h3> Errore nella registrazione </h3></div>";
      }
    } catch(Exception $e) {
      $result = "<div id=\"esito\"><h2>Esito registrazione</h2><h3> Errore nella registrazione </h3></div>";
    }
  }
  else {
    $result="<div id=\"esito\"><h2>Benvenuto</h2><h3> Hai effettuato il login </h3><form action=\"\" method=\"post\"><button type=\"submit\" name=\"exit\">Esci</button><form></div>";
  }

  ses_check();

  function ses_check() {
    conn();
    $user_check = $_SESSION["login_email"];
    $ses_sql = mysql_query("SELECT Email FROM utenti WHERE Email='$user_check'");
    $row = mysql_fetch_assoc($ses_sql);
    $login_session = $row["Email"];
    if(!isset($login_session)) {
      logout();
    }
  }
  
  function logout() {
    if(session_destroy()) {
      header("Location:accesso.php");
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
<html>
  <head>
    <style>
      #esito
      {
        position: absolute;
        width: 16%;
        left: 42%;
        background-color: #eecc00;
        border-radius: 1% 1%;
        padding: 1%;
        font-family: Verdana, sans-serif;
        text-align: center;
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
    <?php echo $result ?> 
  </body>
</html>