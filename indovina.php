<!DOCTYPE HTML>
<?php
  if(!isset($_POST["numero"]))
  {
    $mes="Regole del gioco";
    $mes2="Il giocatore deve indovinare un numero da 1 a 100. Hai a disposizione 7 tentativi, quindi fai attenzione ai numeri che vuoi inserire";
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
      if($_POST["tentativo"] > $_POST["numero"])
      {
        $mes="Tentativo numero " . $_POST["count"];
        
        if($_POST["count"] > 1)
        {
          $mes2="Numero troppo grande!";
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
          $mes2="Numero troppo piccolo!";
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
        $_POST["count"]--;
        $mes="WoW, hai indovinato il numero in " . $_POST["count"] . " tentativo/i!";
        $mes2="";
        $bott="Dai, gioca ancora!";
        unset($_POST["numero"]);
        $_POST["numero"] = rand(1, 100);
        $_POST["count"] = 1;
      }
    }
    else
    {
      $input="hidden";
      $mes="Hai perso!";
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
        background-color: lightblue;
      }
      h1
      {
        color: white;
        text-align: center;
      }
      p
      {
        font-family: verdana;
        font-size: 20px; 
      }
    </style>
  </head>
  <body>
    <title>Gioco dell'indovina numero</title>
    <h1>Gioco dell'indovina numero</h1>
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