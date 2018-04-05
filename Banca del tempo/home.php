<?php
  session_start();
  try {
    $conn = new PDO("mysql:host=localhost;dbname=BancaTempo", "root", "root");
  } catch (PDOexception $e) {
    echo $e->getMessage();
  }
  if(!isset($_SESSION["login_email"])) {
    $reg = "<a href=\"sign_up.php\"><h2>Registrati</h2></a> <a href=\"sign_in.php\"><h2>Accedi</h2></a>";
  } else {
    ses_check($conn);
    if(isset($_POST["logout"])) {
      logout();
    }
    $reg = "<bold>".$_SESSION["login_email"]."</bold> <form action=\"\" method=\"post\"><input type=\"submit\" name=\"logout\" value=\"Esci\"></form>";
    $sql = "SELECT * FROM prestazione AS p INNER JOIN eroga_richiede AS er ON p.idPrestazione=er.idPrestazione INNER JOIN categoria AS c ON c.idCategoria=p.idCategoria WHERE er.idErogante='".$_SESSION["login_email"]."' ORDER BY c.idCategoria";
    $result = $conn->query($sql);
  }

  function ses_check($conn) {
    $user_check = $_SESSION["login_email"];
    $ses_sql = $conn->prepare("SELECT email FROM socio WHERE email=?");
    $ses_sql->execute([$user_check]);
    $row = $ses_sql->fetch();
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
      .new_things {
        position: absolute;
        left: 37%;
        top: 20%;
        font-weight: bold;
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
        left: 32%;
        padding: 10px;
      }
      #title:hover, #title:active, #title:link, #title:visited {
        background-color: #334a78;
        padding: 0px;
      }
      table, th, td {
        border-collapse: collapse;
        /*border: 1px solid grey;*/
        border: none;
        text-align: left;
        padding: 16px;
        background-color: #dddddd;
      }
      th {
        background-color: #8592DD;
        border: none;
      }
    </style>
  </head>
  <body>
    <div class="title">
      <a href="home.php" id="title"><h1 style="font-size:50px">BANCA DEL TEMPO</h1></a>
    </div>
    <div class="reg">
      <?php echo $reg; ?>
    </div>
    <?php
      if(isset($result)) {
        echo "<div class=\"new_things\"><a href=\"new_prest.php\">Nuova prestazione</a> <a href=\"new_cat.php\">Nuova categoria</a></div>\n";
        echo "<div class=\"prest\">\n";
        echo "<table border=\"1\">\n";
        echo "<tr><th>Categoria</th><th>Prestazione</th><th>Erogante</th><th>Richiedente</th><th>Tempo</th></tr>\n";
        while($row = $result->fetch()) {
          echo "<tr><td>".$row["nomeCategoria"]."</td><td>".$row["nomePrestazione"]."</td><td>".$row["idErogante"]."</td><td>".$row["idRichiedente"]."</td><td>".$row["erogaTempo"]."</td></tr>\n";
        }
        echo "</table>\n";
        echo "</div>\n";
      }
    ?>
  </body>
</html>