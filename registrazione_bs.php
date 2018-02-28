<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Modulo di iscrizione</h2>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" action="">
            <div class="form-group">
              <label class="control-label col-sm-2" for="cognome">Cognome:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="cognome" placeholder="Cognome" name="cognome">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nome">Nome:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sesso">Sesso:</label>
              <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" value="m" name="sesso">Maschio</label><label class="radio-inline"><input type="radio" value="f" name="sesso">Femmina</label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nazionalita">Nazionalit&agrave:</label>
              <div class="col-sm-10">
                <select class="form-control" id="nazionalita">
                  <option>Italiana</option>
                  <option>Francese</option>
                  <option>Spagnola</option>
                  <option>Tedesca</option>
                  <option>Inglese</option>
                  <option>Americana</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sesso">Patente:</label>
              <div class="col-sm-10">
                <label class="checkbox-inline"><input type="checkbox" value="a" name="cata">cat. A</label><label class="checkbox-inline"><input type="checkbox" value="b" name="cat">cat. B</label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Password:</label>
              <div class="col-sm-10">          
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
              </div>
            </div>
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="panel-footer">
            <button class="btn" id="annulla">Annulla</button><button class="btn btn-danger" id="conferma">Conferma</button>
        </div>
      </div>
    </div>
  </body>
</html>
