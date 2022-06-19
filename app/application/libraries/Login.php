<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login {
 
		function is_authenticated(){
            //verifica se o usuario está autenticado
 			return true;
			
		}

        function is_accessible_class($class){
        
            //verifica se o usuario tem acesso a classe
            return true;
        
        }
}
 
