<ul class="collapsible">
    <li>
      <div class="collapsible-header" tabindex="0"><i class="material-icons">store</i><?=$this -> lang -> line('cliente')?><span class="badge" id='qtd_clientes'>4</span></div>
      <div class="collapsible-body">
        
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s3"><a id='cliente_menu' class="active" href="#cliente"><?=$this -> lang -> line('clientes')?></a></li>
              <li class="tab col s3"><a id='altera_cliente_menu' href="#altera_cliente"><?=$this -> lang -> line('alterar_cliente')?></a></li>
              <li class="tab col s3"><a href="#cadastro_cli"><?=$this -> lang -> line('cadastrar_cliente')?></a></li>
            </ul>
          </div>
          <div id="cliente" class="col s12">
              <div class="row">
                <div class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="material-icons prefix">search</i>
                      <input type="text" id="autocomplete-input" class="autocomplete">
                      <label for="autocomplete-input">Pesquisar</label>
                    </div>
                  </div>
                </div>
              </div>

            <table class="highlight striped">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Nome</th>
                      <th>Cnpj</th>
                      <th>Status</th>
                      <th>Operações</th>
                  </tr>
                </thead>

                <tbody id="tabela_cliente">
                  <tr>
                    <td>Alvin</td>
                    <td>Eclair</td>
                    <td>$0.87</td>
                    <td>
                            <span class="new badge green" data-badge-caption="Ativo"></span>
                            <span class="new badge red" data-badge-caption="Inativo"></span>
                    </td>
                    <td>
                        <a class="btn-floating btn-small yellow"><i class="material-icons">edit</i></a>
                        <a class="btn-floating btn-small red"><i class="material-icons">delete</i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>Alan</td>
                    <td>Jellybean</td>
                    <td>$3.76</td>
                    <td>$3.76</td>
                    <td>$7.00</td>
                  </tr>
                  <tr>
                    <td>Jonathan</td>
                    <td>Lollipop</td>
                    <td>$7.00</td>
                    <td>$7.00</td>
                    <td>$7.00</td>
                  </tr>
                </tbody>
               
            </table>
                <center>
                  <ul id='paginacao_div' class="pagination">
                      <li class="disabled"><a href="#!" onclick="console.log('antes')"><i class="material-icons">chevron_left</i></a></li>
                     <li class="active"><a href="#!">1</a></li>
                     <li class="waves-effect"><a href="#!">2</a></li>
                     <li class="waves-effect"><a href="#!">3</a></li>
                     <li class="waves-effect"><a href="#!">4</a></li>
                     <li class="waves-effect"><a href="#!">5</a></li>
                     <li class="waves-effect"><a href="#!">6</a></li>
                     <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                  </ul>

                </center>
          </div>
            
            <div id="altera_cliente" class="col s12">
                
                    <div class="row">
                            <form class="col s12">
                              <div class="row">
                                <div class="input-field col l4 m4 s6">
                                  <input id="altera_nome" type="text" class="validate">
                                  <label for="altera_nome" id='label_altera_nome'>Nome</label>
                                </div>
                                <div class="input-field col l4 m4 s6">
                                  <input id="altera_cnpj" type="text" name="altera_cnpj" class="validate" maxlength="18">
                                  <label for="altera_cnpj"  id='label_altera_cnpj'>CNPJ</label>
                                </div>
                                <div class="input-field col l4 m4 s12">
                                  <br>
                                  <div class="switch">
                                    <label>
                                      Inativo
                                      <input id="altera_status" type="checkbox" checked="">
                                      <span class="lever"></span>
                                      Ativo
                                    </label>
                                  </div>

                                </div>
                              </div>
                              <center>
                              <button class="btn waves-effect waves-light" type="button" name="altera_cliente_botao" id="altera_cliente_botao">Alterar
                                <i class="material-icons right">send</i>
                              </button>

                            </center>
                            </form>
                    </div>
                
                
                
                
                
                
                
                
                
                
            </div>
          <div id="cadastro_cli" class="col s12">
            
            
            <div class="row">
              <form class="col s12">
                <div class="row">
                  <div class="input-field col l4 m4 s6">
                    <input id="nome" type="text" class="validate">
                    <label for="nome">Nome</label>
                  </div>
                  <div class="input-field col l4 m4 s6">
                    <input id="cnpj" type="text" name='cnpj' class="validate">
                    <label for="cnpj">CNPJ</label>
                  </div>
                  <div class="input-field col l4 m4 s12">
                    <br>
                    <div class="switch">
                      <label>
                        Inativo
                        <input id="status" type="checkbox" checked>
                        <span class="lever"></span>
                        Ativo
                      </label>
                    </div>
                  
                  </div>
                </div>
                <center>
                <button class="btn waves-effect waves-light" type="button" name="cadastrar_cliente" id='cadastrar_cliente'>Cadastrar
                  <i class="material-icons right">send</i>
                </button>
 
              </center>
              </form>
            </div>
         
            
          </div>
        </div>
      
      
      </div>
    </li>
    <li>
      <div class="collapsible-header" tabindex="0"><i class="material-icons">contacts</i><?=$this -> lang -> line('contato')?><span class="badge"></span></div>
      <div class="collapsible-body">
      
      
      <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" id='botao_menu_contato' href="#test1"><?=$this -> lang -> line('contatos')?></a></li>
        <li class="tab col s3"><a href="#test2" id='alterar_contato_menu'><?=$this -> lang -> line('alterar_contato')?></a></li>
        <li class="tab col s3"><a href="#test3"><?=$this -> lang -> line('cadastrar_contato')?></a></li>
        
      </ul>
    </div>
    <div id="test1" class="col s12">
        <div class="row">
        <div class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">search</i>
              <input type="text" id="autocomplete-input2" class="autocomplete">
              <label for="autocomplete-input2">Pesquisar</label>
            </div>
          </div>
        </div>
      </div>
        
    <table class="highlight striped">
                <thead>
                  <tr>
                      <th>Id</th>
                      <th>Id do cliente</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Cpf</th>
                      <th>Operações</th>
                  </tr>
                </thead>

                <tbody id="tabela_contato">
				<tr>
                    <td>66</td>
                    <td>E Little York Rd Belen ME</td>
                    <td>87.356.694/0001-82</td>
                    <td>87.356.694/0001-82</td>
                    <td>
                        <span class="new badge red" data-badge-caption="Inativo"></span>
                    </td>
                    <td>
                        <a class="btn-floating btn-small yellow" onclick="editar_cliente(66)"><i class="material-icons">edit</i></a>
                        <a class="btn-floating btn-small red" onclick="deletar_cliente(66)"><i class="material-icons">delete</i></a>
                    </td>
                  </tr>
				  </tbody>
               
            </table>
    
    </div>
    <div id="test2" class="col s12">
        
        
        
      <div class="row">
    <form class="col s12">
      <div class="row">
        
        <div class="input-field col s6">
          <input id="altera_nome_contato" type="text" class="validate">
          <label id='label_altera_nome_contato' for="altera_nome_contato">Nome</label>
        </div>
         <div class="input-field col s6">
          <input id="altera_email" type="text" class="validate">
          <label id='label_altera_email' for="altera_email">Email</label>
        </div>
         <div class="input-field col s6">
          <input id="altera_cpf" type="text" class="validate">
          <label id='label_altera_cpf' for="altera_cpf">CPF</label>
        </div>
        <div class="input-field col s6">
          <input id="altera_id_cliente" type="number" class="validate">
          <label id='label_altera_id_cliente' for="altera_id_cliente">ID CLIENTE</label>
        </div>
      </div>
        <p class='center' id='altera_nome_do_cliente'></p>
        <center>
           <button class="btn waves-effect waves-light" type='button' id='altera_cadastra_contato'>Alterar
             <i class="material-icons right">send</i>
           </button>
        </center>
    </form>
  </div>
        
        
    
    
    </div>
    <div id="test3" class="col s12">
        
        
        
        <div class="row">
    <form class="col s12">
      <div class="row">
        
        <div class="input-field col s6">
          <input id="nome_contato" type="text" class="validate">
          <label for="nome_contato">Nome</label>
        </div>
         <div class="input-field col s6">
          <input id="email" type="text" class="validate">
          <label for="email">Email</label>
        </div>
         <div class="input-field col s6">
          <input id="cpf" type="text" class="validate">
          <label for="cpf">CPF</label>
        </div>
        <div class="input-field col s6">
          <input id="id_cliente" type="number" class="validate">
          <label for="id_cliente">ID CLIENTE</label>
        </div>
      </div>
        <p class='center' id='nome_do_cliente'></p>
        <center>
           <button class="btn waves-effect waves-light" id='cadastra_contato' id name="action">Cadastrar
             <i class="material-icons right">send</i>
           </button>
        </center>
    </form>
  </div>
    
    
    
    
    </div>
          
          
          
          
  </div>
      
      
      
      
      
      
      
      </div>
    </li>
  </ul>