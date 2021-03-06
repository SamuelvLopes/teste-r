const url_cadastrar_cliente="http://localhost/cc/app/api/cliente/cadastro";
const url_pesquisar_cliente="http://localhost/cc/app/api/cliente/pesquisar/1";
const url_buscar_cliente="http://localhost/cc/app/api/cliente/busca/1";
const url_buscar_qtd="http://localhost/cc/app/api/cliente/qtd/1";
const url_ler_um_cliente="http://localhost/cc/app/api/cliente/";
const url_alterar_um_cliente="http://localhost/cc/app/api/cliente/alterar/";
const url_deletar_um_cliente="http://localhost/cc/app/api/cliente/excluir/";
const url_recupera_contato_cliente="http://localhost/cc/app/api/cliente/contato/";

const url_buscar_contato="http://localhost/cc/app/api/contato/busca/1";
const url_deletar_um_contato="http://localhost/cc/app/api/contato/excluir/";
const url_buscar_um_contato="http://localhost/cc/app/api/contato/";
const url_cadastrar_um_contato="http://localhost/cc/app/api/contato/cadastro";
const url_alterar_um_contato="http://localhost/cc/app/api/contato/alterar/";
//mascara cnpj
$(document).ready(function(){	
  $("#cnpj").mask("99.999.999/9999-99");
  $("#altera_cnpj").mask("99.999.999/9999-99");
});


//valida cnpj
$("#cnpj").on("blur", function(){
  let cnpj_value = $(this).val();
  
  if(cnpj_value==''){return;}
  if(!jsbrasil.validateBr.cnpj(cnpj_value)) {
      alert("cnpj inválido");
    $("#cnpj").val('');
  } 
});

//valida cnpj
$("#altera_cnpj").on("blur", function(){
  let cnpj_value = $(this).val();
  if(cnpj_value==''){return;}
  if(!jsbrasil.validateBr.cnpj(cnpj_value)) {
      alert("cnpj inválido");
    $("#altera_cnpj").val('');
  } 
});

//mascara cpf
$(document).ready(function(){	
  $("#cpf").mask("999.999.999-99");
  $("#altera_cpf").mask("999.999.999-99");
});


//valida cpf
$("#cpf").on("blur", function(){
  let cpf_value = $(this).val();

  if(cpf_value==''){return;}
  
  if(!jsbrasil.validateBr.cpf(cpf_value)) {
    
      alert("cpf inválido");
      $("#cpf").val('');
  
    } 
});

//valida cpf
$("#altera_cpf").on("blur", function(){
  let cpf_value = $(this).val();

  if(cpf_value==''){return;}
  
  if(!jsbrasil.validateBr.cpf(cpf_value)) {
    
      alert("cpf inválido");
      $("#altera_cpf").val('');
  
    } 
});

//valida altera id cliente
$("#altera_id_cliente").on("blur", function(){
    let id=$("#altera_id_cliente").val();
    if(id==""){
        
        return;
        
    }
    
     let dados={dado:''};
    (async () => {
            const rawResponse = await fetch(url_ler_um_cliente+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            
            const content = await rawResponse.json();
            if(content.length==0){
                alert('esse cliente não existe');
                $("#altera_id_cliente").val('');
                document.getElementById('altera_nome_do_cliente').innerHTML='';
                return;
                
            }
            document.getElementById('altera_nome_do_cliente').innerHTML=content[0].nome;
           
           
            
           
    })();
    
    
    
    
});
//valida id_cliente do contato

$("#id_cliente").on("blur", function(){
    let id=$("#id_cliente").val();
    if(id==""){
        
        return;
        
    }
    
     let dados={dado:''};
    (async () => {
            const rawResponse = await fetch(url_ler_um_cliente+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            
            const content = await rawResponse.json();
            if(content.length==0){
                alert('esse cliente não existe');
                $("#id_cliente").val('');
                document.getElementById('nome_do_cliente').innerHTML='';
                return;
                
            }
            document.getElementById('nome_do_cliente').innerHTML=content[0].nome;
           
           
            
           
    })();
    
    
    
    
});


//valida email alterar
$("#altera_email").on("blur", function(){
    if($("#altera_email").val()==''){
        return;
    }
    if(!validaEmail($("#altera_email").val())){
        
        alert('E-mail invalido');
        $("#altera_email").val('');
        
    }
    
    
});
//valida email
$("#email").on("blur", function(){
    if($("#email").val()==''){
        return;
    }
    if(!validaEmail($("#email").val())){
        
        alert('E-mail invalido');
        $("#email").val('');
        
    }
    
    
});
function validaEmail(email) {
  var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  return regex.test(email);
}

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
     atualizar_all();
    document.getElementById('titulo_alerta').innerHTML=retorno;
    document.getElementById('texto_alerta').innerHTML=motivo;
    
    console.log('o retorno é '+ retorno);
    console.log('o motivo é '+ motivo);
    
    document.getElementById('model_notificao').click();
    
   
}

//atualiza td
function atualizar_all(){
     atualiza_contador_cliente();
	pesquisar_cliente('');
	pesquisar_contato('');
    
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
var ultimo_valor_pesquisado='';
function pesquisar_cliente(valor){
   
   let dados={dado:valor};
    (async () => {
            const rawResponse = await fetch(url_buscar_cliente, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            document.getElementById('tabela_cliente').innerHTML="";
            content.forEach(montar_row_cli);
           
    })();
    
}

//Montar na 



function montar_row_cli(linha){
    //console.log(linha);
    let ativo=`<span class="new badge green" data-badge-caption="Ativo"></span>`;
    let inativo=`<span class="new badge red" data-badge-caption="Inativo"></span>`;
    let status='';
    
    if(linha.status==1){
        status=ativo;
    }else{
        status=inativo;
    }
    let row=`<tr>
                    <td>${linha.id}</td>
                    <td>${linha.nome}</td>
                    <td>${linha.cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5")}</td>
                    <td>
                        ${status}
                    </td>
                    <td>
                        <a class="btn-floating btn-small yellow" onclick='editar_cliente(${linha.id})'><i class="material-icons">edit</i></a>
                        <a class="btn-floating btn-small red" onclick='deletar_cliente(${linha.id})'><i class="material-icons">delete</i></a>
                        <a class="btn-floating btn-small green" onclick='vizualizar_contatos_cliente(${linha.id})'><i class="material-icons">account_circle</i></a>
                   
                    </td>
                  </tr>`;
    document.getElementById('tabela_cliente').innerHTML=row+document.getElementById('tabela_cliente').innerHTML;

}
function vizualizar_contatos_cliente(id){
    
    let dados={dado:'valor'};
    (async () => {
            const rawResponse = await fetch(url_recupera_contato_cliente+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            window.linhas_de_contato='';
        content.forEach(construir_modal)  ;
        //notificar_user(content['retorno'],content['motivo']);
        let table_html=`

      <table>
        <thead>
          <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>CPF</th>
              <th>Email</th>
          </tr>
        </thead>
            ${window.linhas_de_contato}
        <tbody>
          
        </tbody>
      </table>

`;   
        notificar_user('contatos',table_html);
    })();
    
    
}
var linhas_de_contato='';
function construir_modal(item){
    
    
    let row=`<tr>
            <td>${item.id}</td>
            <td>${item.nome_contato}</td>
            <td>${item.cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")}</td>
            <td>${item.email_contato}</td>
          </tr>

        `;
    window.linhas_de_contato=row+window.linhas_de_contato;
    
}
//editar cliente
var cliente_editando=0;

function editar_cliente(id){
   window.cliente_editando=id;
   
   document.getElementById('altera_nome_contato').disabled=true;
   document.getElementById('altera_email').disabled=true;
   document.getElementById('altera_cpf').disabled=true;
   document.getElementById('altera_id_cliente').disabled=true;
   
   document.getElementById('altera_cliente_menu').click(); 
   
   
   preencher_alterar(id);
}

//preenche alterar
function preencher_alterar(id){
        document.getElementById('altera_nome').disabled=false;
        document.getElementById('altera_cnpj').disabled=false;
        document.getElementById('altera_status').disabled=false;
        document.getElementById('altera_cliente').disabled=false;
    let dados={dado:''};
    (async () => {
            const rawResponse = await fetch(url_ler_um_cliente+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            console.log(content);
            let valor=true;
            if(!(content[0].status==1)){
                valor=false;
            }
            document.getElementById('altera_nome').value=content[0].nome;
            document.getElementById('label_altera_nome').setAttribute("class", "active");
            document.getElementById('altera_cnpj').value=content[0].cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
            document.getElementById('label_altera_cnpj').setAttribute("class", "active");
            document.getElementById('altera_status').checked=valor;
            
           
    })();
    console.log(id);
    
}
//limpar alterar
function limpa_alterar(){
            window.contato_alteracao=0;
            document.getElementById('altera_nome_contato').disabled=true;
            document.getElementById('altera_email').disabled=true;
            document.getElementById('altera_cpf').disabled=true;
            document.getElementById('altera_id_cliente').disabled=true;
            document.getElementById('altera_nome_contato').value="";
            document.getElementById('altera_email').value="";
            document.getElementById('altera_cpf').value="";
            document.getElementById('altera_id_cliente').value="";
            window.cliente_editando=0;
            document.getElementById('altera_nome').disabled=true;
            document.getElementById('altera_cnpj').disabled=true;
            document.getElementById('altera_status').disabled=true;
            document.getElementById('altera_cliente').disabled=true;
            document.getElementById('altera_nome').value="";
            document.getElementById('altera_cnpj').value="";
}
//deletar cliente
function deletar_cliente(id){
    console.log(id);
    let dados={dado:'valor'};
    (async () => {
            const rawResponse = await fetch(url_deletar_um_cliente+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            notificar_user(content['retorno'],content['motivo']);
           
    })();
    pesquisar_cliente('');
    limpa_alterar();
}
function atualiza_contador_cliente(){
	
	let dados={dado:''};
    (async () => {
            const rawResponse = await fetch(url_buscar_qtd, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            document.getElementById('qtd_clientes').innerHTML=content[0][0];
           
    })();
}
//atualiza dados de contagem
$(window).on("load", function(){
   
   atualiza_contador_cliente();
	pesquisar_cliente('');
	pesquisar_contato('');
	return;
   
   
});
    
$("#altera_cliente_menu").on("click", function(){
    if(window.cliente_editando==0){
        
        alert('você não ainda não escolheu um cliente para editar');   

        document.getElementById('altera_nome').disabled=true;
        document.getElementById('altera_cnpj').disabled=true;
        document.getElementById('altera_status').disabled=true;
        document.getElementById('altera_cliente').disabled=true;
  
    }
    
});

$("#altera_cliente_botao").on("click", function(){
     if(window.cliente_editando==0){
        
        alert('você não ainda não escolheu um cliente para editar');   
        document.getElementById('cliente_menu').click();
        return;
     }
     let ativo=0;
   
     if($('#altera_status').is(':checked')===true){
    ativo=1;
    }else{
        ativo=0;
    }

        
       let dados={
           id:window.cliente_editando,
           nome:document.getElementById('altera_nome').value,
           cnpj:document.getElementById('altera_cnpj').value,
           status:ativo
       };
       
       
      
    (async () => {
            const rawResponse = await fetch(url_alterar_um_cliente+window.cliente_editando, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            notificar_user(content['retorno'],content['motivo']);
            document.getElementById('cliente_menu').click();
            window.cliente_editando=0;
            document.getElementById('altera_nome').disabled=true;
            document.getElementById('altera_cnpj').disabled=true;
            document.getElementById('altera_status').disabled=true;
            document.getElementById('altera_cliente').disabled=true;
            document.getElementById('altera_nome').value="";
            document.getElementById('altera_cnpj').value="";
            pesquisar_cliente('');
    })();
    
});


function pesquisar_contato(valor){
   document.getElementById('tabela_contato').innerHTML="";
   let dados={dado:valor};
    (async () => {
            const rawResponse = await fetch(url_buscar_contato, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            document.getElementById('tabela_contato').innerHTML="";
            content.forEach(montar_row_co);
           
            
           
    })();
    
}

function montar_row_co(linha){
    
    
    let row=`
                  <tr>
                    <td>${linha.id}</td>
                    <td>${linha.id_cliente}</td>
                    <td>${linha.nome_contato}</td>
                    <td>${linha.email_contato}</td>
                    <td>${linha.cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")}</td>
                    <td>
                        <a class="btn-floating btn-small yellow" onclick="editar_contato(${linha.id})"><i class="material-icons">edit</i></a>
                        <a class="btn-floating btn-small red" onclick="deletar_contato(${linha.id})"><i class="material-icons">delete</i></a>
                    </td>
                  </tr>


        `;
    document.getElementById('tabela_contato').innerHTML=row+document.getElementById('tabela_contato').innerHTML;
    
    
}
//edita contato
function editar_contato(id){
    window.contato_alteracao=id;
    preencher_altera_contato(id);
    
}
//deletar contato
function deletar_contato(id){
    
   console.log(id);
    let dados={dado:'valor'};
    (async () => {
            const rawResponse = await fetch(url_deletar_um_contato+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            notificar_user(content['retorno'],content['motivo']);
           
    })();
    pesquisar_contato('');
    limpa_alterar()
    
    
}

//cadastro de contato
$("#cadastra_contato").on("click", function(){
       
    if(document.getElementById('nome_contato').value==''||document.getElementById('email').value==''||document.getElementById('cpf').value==''||document.getElementById('id_cliente').value==''){
        
        
        alert('preencha todos os campos')
        return;
    }
    let dados={
        cpf:document.getElementById('cpf').value,
        nome:document.getElementById('nome_contato').value,
        email:document.getElementById('email').value,
        id_cliente:document.getElementById('id_cliente').value
            };
            
        
    (async () => {
            const rawResponse = await fetch(url_cadastrar_um_contato, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            notificar_user(content['retorno'],content['motivo']);
           
    })();
    document.getElementById('cpf').value='';
    document.getElementById('nome_contato').value='';
    document.getElementById('email').value='';
    document.getElementById('id_cliente').value='';
    document.getElementById('nome_do_cliente').value='';
    document.getElementById('botao_menu_contato').click();
       atualizar_all();
    
});

//acesso ao alterar contato
$("#alterar_contato_menu").on("click", function(){
    
    if(window.contato_alteracao==0){
        alert('é necessario escolher um contato primeiro');
        limpa_alterar();
        
    }
    
});
// botão alterar

var contato_alteracao=0;

$("#altera_cadastra_contato").on("click", function(){
    
    
     if(document.getElementById('altera_nome_contato').value==''||document.getElementById('altera_email').value==''||document.getElementById('altera_cpf').value==''||document.getElementById('altera_id_cliente').value==''){
        
        alert('preencha todos os campos');
         return;
         
     }
     
     let dados={
         id:window.contato_alteracao,
         cpf:document.getElementById('altera_cpf').value,
         id_cliente:document.getElementById('altera_id_cliente').value,
         email:document.getElementById('altera_email').value,
         nome:document.getElementById('altera_nome_contato').value
         
         
     };
     
     
     (async () => {
            const rawResponse = await fetch(url_alterar_um_contato+window.contato_alteracao, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            notificar_user(content['retorno'],content['motivo']);
           
    })();
     window.contato_alteracao=0;
     document.getElementById('altera_cpf').value='';
     document.getElementById('altera_id_cliente').value='';
     document.getElementById('altera_email').value='';
     document.getElementById('altera_nome_contato').value='';
     
     
     
     
     
    
    
});

function preencher_altera_contato(id){
    
    document.getElementById('alterar_contato_menu').click();
    let dados={dado:'valor'};
    (async () => {
            const rawResponse = await fetch(url_buscar_um_contato+id, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(dados)
            });
            const content = await rawResponse.json();
            console.log(content);
            document.getElementById('altera_nome_contato').value=content[0].nome_contato;
            document.getElementById('label_altera_nome_contato').setAttribute("class", "active");
            document.getElementById('altera_email').value=content[0].email_contato;
            document.getElementById('label_altera_email').setAttribute("class", "active");
            document.getElementById('altera_cpf').value=content[0].cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
            document.getElementById('label_altera_cpf').setAttribute("class", "active");
            document.getElementById('altera_id_cliente').value=content[0].id_cliente;
            document.getElementById('label_altera_id_cliente').setAttribute("class", "active");
            //notificar_user(content['retorno'],content['motivo']);
           
    })();
    
    
}
