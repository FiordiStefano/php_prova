$(document).ready(function() {
  $("#form_login").hide();
  $("#btn_home").hide();
  $("#btn_ana").hide();
  $("#btn_spese").hide();
  
  $("#btn_login").click(function() {
    $("#home").hide();
    $("#form_login").show();
    $("#btn_login").hide();
    $("#btn_home").show();
  });
  
  $("#btn_home").click(function() {
    $("#form_login").hide();
    $("#home").show();
    $("#btn_login").show();
    $("#btn_home").hide();
  });
  
  $("login").click(function() {
    $.getJSON("Cond_model.php", $("#email").val(),
      $("#passwd").val(), function(result) {
        if(result != null) {
          $("#form_login").hide();
          $("#login_succ").show();
        }
    });
  });
});