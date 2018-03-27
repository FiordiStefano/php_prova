<?php
  session_start();
  if(!isset($_SESSION["login_email"])) {
    $reg = "<a href=\"sign_up.php\"><h2>Registrati</h2></a> <a href=\"sign_in.php\"><h2>Accedi</h2></a>";
  } else {
    ses_check();
    if(isset($_POST["logout"])) {
      logout();
    }
    $reg = "<bold>".$_SESSION["login_email"]."</bold> <form action=\"\" method=\"post\"><input type=\"submit\" name=\"logout\" value=\"Logout\"></form>";
    $sql = "SELECT * FROM prestazione AS p INNER JOIN eroga_richiede AS er ON p.idPrestazione=er.idPrestazione WHERE er.idErogante='".$_SESSION["login_email"]."'";
    $result = mysql_query($sql);
  }

  function ses_check() {
    conn();
    $user_check = $_SESSION["login_email"];
    $ses_sql = mysql_query("SELECT email FROM socio WHERE email='$user_check'");
    $row = mysql_fetch_assoc($ses_sql);
    $login_session = $row["email"];
    if(!isset($login_session)) {
      logout();
    }
  }
  
  function logout() {
    if(session_destroy()) {
      header("Location:home.php");
    }
  }

  function conn() {
    mysql_connect("localhost", "root", "root") or die ("Impossibile connettersi al server: " . mysql_error());
    mysql_select_db("BancaTempo") or die ("Accesso al db non riuscito: " . mysql_error());
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Banca del tempo home</title>
    <style>
      body {
        color: white;
        background-color: #334a78;
        font-family: verdana, thin;
        text-align: center;
      }
      .reg {
        margin-top: 16px;
        float: right;
        margin-right: 24px;
        display: inline-block;
        text-align: center;
      }
      .title {
        display: inline-block;
        margin-left: 24px;
        float: left;
      }
      a:link, a:visited {
        background-color: #8592DD;
        color: white;
        padding: 14px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
      }
      a:hover, a:active, input[type=submit]:hover, input[type=submit]:active {
          background-color: #6F7FDD;
      }
      input[type=submit] {
        background-color: #8592DD;
        color: white;
        padding: 24px 32px;
        text-align: center;
        border: none;
        font-size: 20px;
        font-weight: bold;
        margin-top: 16px;
      }
      .prest {
        background-color: white;
        color: black;
        position: absolute;
        top: 25%;
        left: 35%;
        padding: 1%;
      }
    </style>
  </head>
  <body>
    <div class="title">
      <h1 style="font-size:50px">BANCA DEL TEMPO</h1>
    </div>
    <div class="reg">
      <?php echo $reg; ?>
    </div>
    <?php
      if(isset($result)) {
        echo "<div class=\"prest\">\n";
        echo "<table border=\"1\">\n";
        echo "<tr><th>Prestazione</th><th>Erogante</th><th>Richiedente</th><th>Tempo</th></tr>\n";
        while($row = mysql_fetch_array($result)) {
          echo "<tr><td>".$row["nomePrestazione"]."</td><td>".$row["idErogante"]."</td><td>".$row["idRichiedente"]."</td><td>".$row["erogaTempo"]."</td></tr>\n";
        }
        echo "</table>\n";
        echo "</div>\n";
      }
    ?>
  </body>
</html>