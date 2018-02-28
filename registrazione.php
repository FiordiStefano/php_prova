<!DOCTYPE HTML>
<head>
  <style>
    #inserimento
    {
      position: absolute;
      width: 16%;
      left: 42%;
      background-color: #0099ff;
      border-radius: 1% 1%;
      padding: 1%;
      color: white;
      font-family: Verdana, sans-serif;
    }
    #registrazione
    {
      text-align: right;
    }
    label
    {
      margin-right: 5%;
    }
    select, [type=text], [type=password]
    {
      width: 60%;
    }
  </style>
</head>
<body>
  <div id="inserimento">
    <h2>Modulo di iscrizione</h2>
    <form id="registrazione" action="" method="post">
      <label>Cognome:</label><input type="text" name="cognome">
      <br><br>
      <label>Nome:</label><input type="text" name="nome">
      <br><br>
      <label>Sesso:</label><input type="radio" name="sesso" value="maschio">Maschio <input type="radio" name="sesso" value="femmina">Femmina
      <br><br>
      <label>Nazionalit&agrave:</label><select name="nazionalita"><option value="italiana">Italiana</option><option value="francese">Francese</option><option value="spagnola">Spagnola</option><option value="tedesca">Tedesca</option></select>
      <br><br>
      <label>Patente:</label><input type="checkbox" name="catA" value="catA">Cat. A <input type="checkbox" name="catB" value="catB">Cat. B
      <br><br>
      <label>E-mail:</label><input type="text" name="email">
      <br><br>
      <label>Password:</label><input type="password" name="password">
      <br><br>
    </form>
    <button>Annulla</button><button>Conferma</button>
  </div>
</body>