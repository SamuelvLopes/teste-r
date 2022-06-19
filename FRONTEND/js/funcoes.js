const url_cadastrar_cliente="http://localhost/cc/app/api/cliente/cadastro";
const url_pesquisar_cliente="http://localhost/cc/app/api/cliente/pesquisar/1";

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
    
  if($("#nome").val()===""){
      alert('O nome está vazio');
      return;
  }
  if($("#cnpj").val()===""){
      alert('O cnpj está vazio');
      return;
  }
  var ativo;
  
if($('#status').is(':checked')===true){
    ativo=1;
}else{
    ativo=0;
}

var dados={
    nome:$("#nome").val(),
    cnpj:$("#cnpj").val(),
    status:ativo
};



(async () => {
  const rawResponse = await fetch(url_cadastrar_cliente, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(dados)
  });
  const content = await rawResponse.json();
  notificar_user(content.retorno,content.motivo);
  
})();

$("#cnpj").val("");
$("#nome").val("");
  
});

//notificar do retorno
function notificar_user(retorno,motivo){
    
    document.getElementById('titulo_alerta').innerHTML=retorno;
    document.getElementById('texto_alerta').innerHTML=motivo;
    
    console.log('o retorno é '+ retorno);
    console.log('o motivo é '+ motivo);
    
    document.getElementById('model_notificao').click();
}

//carregar pagina
function carregar_pagina_clientes(pag){
    
}

//construir paginacao
function carregar_paginacao(){
    
}
//atualizar o data
function atualizar_pesquisa_cliente(valor){
   
    let dados={dado:valor};
    (async () => {
            const rawResponse = await fetch(url_pesquisar_cliente, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            content.forEach(add_dados);
           
    })();
    
}

function add_dados(retorno){
       dados[retorno['titulo']+" : "+retorno['return']]=null;
       
}

//pesquisar

function pesquisar_cliente(valor){
    
    console.log('valor',valor)
    
}