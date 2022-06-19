//mascara cnpj
$(document).ready(function(){	
  $("#cnpj").mask("99.999.999/9999-99");
});


//valida cnpj
$("#cnpj").on("blur", function(){
  let cnpj_value = $(this).val();
  
  if(!jsbrasil.validateBr.cnpj(cnpj_value)) {
      alert("cnpj inválido");
    $("#cnpj").val('');
  } 
});


//mascara cpf
$(document).ready(function(){	
  $("#cpf").mask("999.999.999-99");
});


//valida cpf
$("#cpf").on("blur", function(){
  let cpf_value = $(this).val();

  if(!jsbrasil.validateBr.cpf(cpf_value)) {
    
      alert("cpf inválido");
      $("#cpf").val('');
  
    } 
});

//ação de cadastrar cliente
$("#cadastrar_cliente").on("click", function(){
    
  if($("#nome").val()==""){
      alert('O nome está vazio');
      return;
  }
  if($("#cnpj").val()==""){
      alert('O cnpj está vazio');
      return;
  }



  console.log($("#status").val());



  $.ajax({
    //URL@ALTERAR
    url : "cadastrar.php",
    type : 'post',
    data : {
         nome : "Maria Fernanda",
         salario :'3500'
    },
    beforeSend : function(){
         $("#resultado").html("ENVIANDO...");
    }
})
.done(function(msg){
    $("#resultado").html(msg);
})
.fail(function(jqXHR, textStatus, msg){
    alert(msg);
});
  

  
});