
(function($){
  $(function(){
    M.AutoInit();
    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space



  var dados={};
  const node2 = document.getElementById('autocomplete-input2');
        node2.addEventListener("keyup", function(event) {
        if(event.key=='Enter'){
        pesquisar_contato(document.getElementById('autocomplete-input2').value);
        return;
    }  
            
            
        });
  const node = document.getElementById('autocomplete-input');
        node.addEventListener("keyup", function(event) {
         window.dados={};
        
    atualizar_pesquisa_cliente(document.getElementById('autocomplete-input').value);
    document.getElementById('autocomplete-input').click();
    if(event.key=='Enter'){
        pesquisar_cliente(document.getElementById('autocomplete-input').value);
        return;
    }   
    $('input.autocomplete').autocomplete({
       
         data: dados
       });
       $('input.autocomplete2').autocomplete({
       
         data: dados
       });
       document.getElementById('autocomplete-input').click();
       
});


    
    



