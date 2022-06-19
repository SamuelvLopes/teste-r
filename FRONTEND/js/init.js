
(function($){
  $(function(){
    M.AutoInit();
    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(document).ready(function(){	
  $("#cnpj").mask("99.999.999/9999-99");
});

$("#cnpj").on("blur", function(){
  let cnpj_value = $(this).val();
  
  if(!jsbrasil.validateBr.cnpj(cnpj_value)) {
      alert("cnpj inválido");
    $("#cnpj").val('');
  } 
});


$(document).ready(function(){	
  $("#cpf").mask("999.999.999-99");
});

$("#cpf").on("blur", function(){
  let cpf_value = $(this).val();

  if(!jsbrasil.validateBr.cpf(cpf_value)) {
    
      alert("cpf inválido");
      $("#cpf").val('');
  
    } 
});