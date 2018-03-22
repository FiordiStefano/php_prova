<!DOCTYPE html>
 <?php  
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
        $result = "<div id=\"esito\"><h2>Esito registrazione</h2><h3> Utente registrato correttamente </h3></div>";
      }
      else {
        $result = "<div id=\"esito\"><h2>Esito registrazione</h2><h3> Errore nella registrazione </h3></div>";
      }
    } catch(Exception $e) {
      $result = "Errore";
    }
  }
  else {
    $result="<div id=\"esito\"><h2>Benvenuto</h2><h3> Hai effettuato il login </h3></div>";
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
    </style>
  </head>
  <body>
    <?php echo $result ?> 
  </body>
</html>