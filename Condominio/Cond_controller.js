$(document).ready(function() {
  $("#login_succ").hide();
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
    $("#login_succ").hide();
  });
  
  $("#canc").click(function() {
    $('#email').val('');
    $('#passwd').val('');
  });
  
  $("#login").click(function() {
    $.getJSON("Cond_model/Cond_login.php", { "email": $("#email").val(),
      "passwd": $("#passwd").val() }, function(result) {
        if (result.length > 0) {
          $("#form_login").hide();
          $("#login_succ").show();
        }
    });
  });
});