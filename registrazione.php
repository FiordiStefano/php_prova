<!DOCTYPE HTML>
<?php
  $titolo="<h2>Modulo di iscrizione<h2>";
?>
<head>
  
</head>
<body>
  <?php echo $titolo; ?>
  <form action="" method="post">
    <p>Cognome:</p><input type="text" name="cognome">
    <p>Nome:</p><input type="text" name="nome">
    <p>Sesso:</p><input type="radio" name="sesso" value="maschio">Maschio <input type="radio" name="sesso" value="femmina">Femmina
    <p>Nazionalit&agrave:</p><input list="nazionalita" name="nazionalita"><datalist id="nazionalita"><option value="Italiana"><option value="Francese"><option value="Spagnola"><option value="Tedesca"></datalist>
    <p>Patente:</p><input type="checkbox" name="catA" value="catA">Cat. A <input type="checkbox" name="catB" value="catB">Cat. B
    <p>E-mail:</p><input type="text" name="email">
    <p>Password:</p><input type="password" name="password">
    <br>
    <input type="submit" name="annulla" value="Annulla"> <input type="submit" name="conferma" value="Conferma">
  </form>
</body>