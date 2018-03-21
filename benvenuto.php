<!DOCTYPE html>
 <?php
  if(isset($_POST["regButton"]))
  {
    $nome = test_input($_POST["nome"]);
    $email = test_input($_POST["email"]);
    $cognome = test_input($_POST["cognome"]);
    $password = test_input($_POST["password"]);
    $nazionalita = test_input($_POST["nazionalita"]);
    $sesso = test_input($_POST["sesso"]);
    $password = test_input($_POST["password"]);
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
    mysql_connect("localhost", "root", "root") or die ("Impossibile connettersi al server: " . mysql_error());
    mysql_select_db("php_web") or die ("Accesso al db non riuscito: " . mysql_error());
    $sql = "INSERT INTO utenti (Cognome, Nome, Sesso, Nazionalita, Patente, Email, Password) VALUES ('$cognome', '$nome', '$sesso', '$nazionalita', '$patente', '$email', '$password')";
    if (mysql_query($sql)) {
      $result = "Utente aggiunto correttamente";
    }
    else {
      $result = "Errore nell'inerimento: " . mysql_error();
    }
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
  </head>
  <body>
    <h2><?php echo $result; ?></h2>
    <p><?php echo $nome; ?></p>
    <p><?php echo $cognome; ?></p>
    <p><?php echo $sesso; ?></p>
    <p><?php echo $nazionalita; ?></p>
    <p><?php echo $patente; ?></p>
    <p><?php echo $email; ?></p>
    <p><?php echo $password; ?></p>
  </body>
</html>