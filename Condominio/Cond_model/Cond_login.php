<?php
  try {
    $pdo = new PDO("mysql:host=localhost;dbname=Condominio", "root", "root");

    $email = test_input($_GET["email"]);
    $passwd = test_input($_GET["passwd"]);
    $query = $pdo->prepare("SELECT * FROM Utente WHERE email=? AND password=?");
    $query->execute([$email, $passwd]);
    $result = $query->fetchAll();
    $obj_json = json_encode($result);
    print($obj_json);
  }
  catch (PDOException $ex) {} 

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>