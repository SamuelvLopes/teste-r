<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Lib {
 
		function what_lang(){
            
            
            
            if(!isset($_GET['lang'])){
                $idioma='pt';
            }else{
                $idioma=$_GET['lang'];
            }

            switch($idioma){

                case'pt':
                    return ['pt','portuguese'];
                break;
                case 'en':
                    return ['en','english'];
                break;
                default:
                    return ['pt','portuguese'];
                break;
                

            }
 			
			
		}

}
 