<?php
  session_start();
?>

<!DOCTYPE HTML>
<html>
  <head>
  </head>
  <body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if(isset($_POST["reload"]))
      {
        session_unset();
        session_destroy();
        header("Refresh:0");
      }
      else
      {
        $numero = test_input($_POST["numero"]);
        if($_SESSION["n"] > $numero)
        {
          $res = "<h3>Il numero è troppo piccolo</h3>";
          $_SESSION["count"]++;
        }
        else if($_SESSION["n"] < $numero)
        {
          $res = "<h3>Il numero è troppo grande</h3>";
          $_SESSION["count"]++;
        }
        else
        {
          $_SESSION["vis"] = "none";
          $res = "BRAVO!<br>Hai indovinato in ". $_SESSION["count"] ." tentativi.<br><br><form action=\"\" method=\"post\"><input type=\"submit\" name=\"reload\" value=\"Gioca di nuovo\"></form>";
        }
        if($_SESSION["count"] > 7)
        {
          $_SESSION["vis"] = "none";
          $res = "Spiacenti...<br>hai superato il massimo di 7 tentativi.<br><br><form action=\"\" method=\"post\"><input type=\"submit\" name=\"reload\" value=\"Gioca di nuovo\"></form>";
        }
      }
    }
    else 
    {
      $_SESSION["vis"] = "block"; 
      $_SESSION["count"] = 1;
      $_SESSION["n"] = rand(1, 100);
      $res="";
    } 
      
    function test_input($data) 
    {
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
      <?php if(isset($res)){ echo $res; }?>
      <div style="display: <?php echo $_SESSION["vis"]; ?>;">
        <p>Tentativo n.<?php echo $_SESSION["count"]; ?>
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
    </div>
  </body>
</html>