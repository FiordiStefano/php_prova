<!DOCTYPE HTML>
<html>
  <head>
  </head>
  <body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
    }
    else {
      $count = 1;
      $n = rand(1, 100);
      $numero = 0;
    } 
      
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>
    <div>
      <h2>
        Gioco dell'indovina numero
      </h2>
      <p>
        Tentativo n.<?php echo $count ?>
        <br>
        <strong>Inserisci il numero</strong>
      </p>
      <br>
      <form action="" method="post">
        <input type="text" name="numero">
        <br>
        <input type="submit" name="conferma" value="Conferma">
      </form> 
    </div>
  </body>
</html>