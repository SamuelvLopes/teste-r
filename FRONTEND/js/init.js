
(function($){
  $(function(){
    M.AutoInit();
    $('.sidenav').sidenav();

  }); // end of document ready
})(jQuery); // end of jQuery name space



  var dados={};
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


    
    



