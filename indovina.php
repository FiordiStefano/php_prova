<!DOCTYPE HTML>
<?php
  if(!isset($_POST["numero"]))
  {
    $mes="<strong>Regole del gioco</strong>";
    $mes2="Il giocatore deve indovinare un numero compreso fra 1 e 100 in max 7 tentativi.";
    $bott="Inizia il gioco";
    $_POST["numero"] = rand(1, 100);
    $_POST["count"] = 1;
    $input = "hidden";
  }
  else
  {
    $input="text";
    if($_POST["count"] <= 7)
    {
      $mes="Tentativo n." . $_POST["count"] ."<br><strong>Inserisci il numero</strong>";
      if($_POST["tentativo"] > $_POST["numero"])
      {        
        if($_POST["count"] > 1)
        {
          $mes2="Il numero &egrave troppo grande!";
        }
        else
        {
          $mes2="";
        }
        
        $bott="Conferma";
        $_POST["count"]++;
      }
      else if($_POST["tentativo"] < $_POST["numero"])
      {              
        if($_POST["count"] > 1)
        {
          $mes2="Il numero &egrave troppo piccolo!";
        }
        else
        {
          $mes2="";
        }
        
        $bott="Conferma";
        $_POST["count"]++;
      }
      else
      {
        $input="hidden";
        $mes="BRAVO!<br>Hai indovinato in " . $_POST["count"] . " tentativi!";
        $mes2="";
        $bott="Gioca di nuovo";
        unset($_POST["numero"]);
        $_POST["numero"] = rand(1, 100);
        $_POST["count"] = 1;
      }
    }
    else
    {
      $input="hidden";
      $mes="Spiacenti...<br>Hai superato il max di 7 tentativi.";
      $mes2="";
      $bott="Ritenta";
      unset($_POST["numero"]);
      $_POST["numero"] = rand(1, 100);
      $_POST["count"] = 1;
    }
  }
?>
<html>
  <head>
    <style>
      body
      {
        background-color: lightgreen;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <title>Gioco dell'indovina numero</title>
    <h2>Gioco dell'indovina numero</h2>
    <p><?php echo $mes; ?></p>
    <p><?php echo $mes2; ?></p>
    <form action="" method="post">
      <p><input type="<?php echo $input; ?>" name="tentativo"></p>
      <input type="hidden" name="numero" value="<?php echo $_POST["numero"]; ?>">
      <input type="hidden" name="count" value="<?php echo $_POST["count"]; ?>">
      <p><input type="submit" value="<?php echo $bott; ?>"></p>
    </form>
  </body>
</html>