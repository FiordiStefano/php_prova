<!DOCTYPE HTML>
<?php
  if(!isset($_POST["conferma"]))
  {
    $titolo="<h2>Modulo di iscrizione<h2>";
    $cognome="<p>Cognome:</p><input type=\"text\" name=\"cognome\">";
    $nome="<p>Nome:</p><input type=\"text\" name=\"nome\">";
    $sesso="<p>Sesso:</p><input type=\"radio\" name=\"sesso\" value=\"maschio\">Maschio <input type=\"radio\" name=\"sesso\" value=\"femmina\">Femmina";
    $nazionalita="<p>Nazionalit&agrave:</p><select name=\"nazionalita\"><option value=\"italiana\">Italiana</option><option value=\"francese\">Francese</option><option value=\"spagnola\">Spagnola</option><option value=\"tedesca\">Tedesca</option></select>";
    $patente="<p>Patente:</p><input type=\"checkbox\" name=\"catA\" value=\"catA\">Cat. A <input type=\"checkbox\" name=\"catB\" value=\"catB\">Cat. B";
    $email="<p>E-mail:</p><input type=\"text\" name=\"email\">";
    $password="<p>Password:</p><input type=\"password\" name=\"password\">";
    $form=$cognome . $nome . $sesso . $nazionalita . $patente . $email . $password;
  }
  else
  {
    $titolo="<h2>Riepilogo dati<h2>";
    $text="hidden";
    $radio="hidden";
    $select=$_POST["nazionalita"];
    $checkbox="hidden";
    $password="hidden";
  }
?>
<head>
  
</head>
<body>
  <?php echo $titolo; ?>
  <form action="" method="post">
    <?php echo $form; ?>
    <br>
    <input type="submit" name="annulla" value="Annulla"> <input type="submit" name="conferma" value="Conferma">
  </form>
</body>