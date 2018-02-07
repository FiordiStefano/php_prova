<!DOCTYPE HTML>
<html>
  <head>
  </head>
  <body>
    <?php
      $count = 1;
      $n = rand(1, 100);
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
      <form action="indovinaAlg.php" method="post">
        <input type="text" name="numero">
        <br>
        <input type="submit" name="conferma" value="Conferma">
      </form> 
    </div>
  </body>
</html>