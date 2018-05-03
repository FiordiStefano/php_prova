<?php
  $pdo = new PDO("mysql:host=localhost;dbname=Condominio", "root", "root")

  if(isset($_POST["email"]) && isset($_POST["passwd"])) {
    $email = test_input($_POST["email"]);
    $passwd = test_input($_POST["passwd"]);
    $query = $pdo->prepare("SELECT * FROM Utente WHERE email=? AND password=?");
    $query->execute([$email, $passwd]);
    if($query->rowcount() == 0) {
      
    } else {
      
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>