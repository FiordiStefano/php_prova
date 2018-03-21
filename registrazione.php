<!DOCTYPE HTML>
<head>
  <style>
    #formRegistrazione, #confermaModulo
    {
      position: absolute;
      width: 16%;
      left: 42%;
      background-color: #0099ff;
      border-radius: 1% 1%;
      padding: 1%;
      color: white;
      font-family: Verdana, sans-serif;
      text-align: right;
    }
    #confermaModulo, h2
    {
      text-align: left;
    }
    label
    {
      margin-right: 5%;
    }
    .formRegistrazione
    {
      width: 60%;
      margin-bottom: 5%;
    }
    select, #em
    {
      margin-top: 5%;
    }
    button, input[type=submit]
    {
      background-color: #ff5500;
      border: none;
      border-radius: 8px;
      color: white;
      padding: 10px 20px;
      margin: 4px 2px;
      cursor: pointer;
    }
    button:active, input[type=submit]:active
    {
      background-color: #ffaa00;
    }
  </style>
  <script>
    function ConfermaModulo(){
        for(var i=0; i<document.getElementsByClassName("formRegistrazione").length - 1; i++){
            if(document.getElementsByClassName("formRegistrazione")[i].value==""){               
               alert("non hai inserito tutti i campi");
              return;
            }
            else 
               document.getElementsByName("riepilogoTextForm")[i].innerHTML =document.getElementsByClassName("formRegistrazione")[i].value;
                                                                          
        }
        if(document.getElementsByName("sesso")[0].checked==false && document.getElementsByName("sesso")[1].checked==false){
             alert("non hai inserito tutti i campi");
             return;
        }
        else if(document.getElementsByName("sesso")[0].checked==true){
                  document.getElementsByName("riepilogoRadioForm")[0].innerHTML="maschio";
        }
        else if(document.getElementsByName("sesso")[1].checked==true){
                  document.getElementsByName("riepilogoRadioForm")[0].innerHTML="femmina";
        }
        if(document.getElementsByName("patenteA")[0].checked==true){
                  document.getElementsByName("riepilogoCheckboxForm")[0].innerHTML="A ";
        }
        if(document.getElementsByName("patenteB")[0].checked==true){
                  document.getElementsByName("riepilogoCheckboxForm")[0].innerHTML+="B";
        }
        document.getElementById("formRegistrazione").style.display="none";
        document.getElementById("confermaModulo").style.display="block";
    }
    
    function back() {
      document.getElementById("formRegistrazione").style.display="block";
      document.getElementById("confermaModulo").style.display="none";
    }
    
    function reset() {
      for(var i=0; i<document.getElementsByClassName("formRegistrazione").length - 1; i++){
        document.getElementsByClassName("formRegistrazione")[i].value=""
      }
    }
  </script>
</head>
<body>
    <form action="benvenuto.php" method="post">
      <div id="formRegistrazione">
        <h2>Modulo di iscrizione</h2>
        <label>Nome: </label><input type="text" class="formRegistrazione" name="nome">
        <label>Cognome: </label><input type="text" class="formRegistrazione" name="cognome">
        <label>Sesso: </label><input type="radio" name="sesso" value="M">Maschio <input type="radio" name="sesso" value="F"> Femmina
        <label>Nazionalit&agrave:</label>  
        <select id="nazionalita" class="formRegistrazione" name="nazionalita">
          <option value="italiana">Italiana</option>
          <option value="tedesca">Tedesca</option>
          <option value="francese">Francese</option>
        </select>
        <label>Patente: </label><input type="checkbox" class="patente" name="patenteA" value="A">Cat. a <input type="checkbox" class="patente" name="patenteB" value="B"> Cat. b<br>
        <label>Email: </label><input id="em" type="text" class="formRegistrazione" name="email">
        <label>Password: </label><input type="password" class="formRegistrazione" name="password">
        <button type="button" name="annulla" onclick="reset()">Annulla</button>
        <button type="button" name="conferma" onclick="ConfermaModulo()">Conferma</button>
      </div>
      <div id="confermaModulo" style="display:none;" >
        <h2>Riepilogo dati</h2>
        <h4>Nome:</h4><p name="riepilogoTextForm"> </p>       
        <h4>Cognome:</h4><p name="riepilogoTextForm"> </p>
        <h4>Sesso:</h4><p name="riepilogoRadioForm"> </p>
        <h4>Nazionalit&agrave:</h4><p name="riepilogoTextForm"> </p>
        <h4>Patente:</h4><p name="riepilogoCheckboxForm"> </p>
        <h4>Email:</h4><p name="riepilogoTextForm"> </p>
        <button type="button" name="correggi" onclick="back()">Correggi</button>
        <input type="submit" value="Registra" name="regButton">
      </form>
    </div>
  </body>