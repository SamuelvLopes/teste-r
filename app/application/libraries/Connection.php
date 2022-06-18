<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Connection{


    /**
			 * Executa query
             * 
			 * @param string $sql
             * $sql="SELECT * FROM CLIENTE WHERE id=:id"
			 * @param array $arg
             * OPCIONAL                  
             * $arg[]=['key'=>':id',"value"=>$id];
             * recebe os argumentos que serão utilizados para construção da query espera receber um array no seguinte formato:
             *                            [ [] ] ou [ [] , [] , ... ]
             * ex: ['key'=>':valor1',"value"=>'valor1'],[['key'=>':valor2',"value"=>'valor2']]]
             * A função utiliza as chaves key e value para identificar o que deve ser sustituido através do bindParam
			 * @return array
             
	*/
function query($sql,$arg =0){
    
   

   if($arg!=0){
           
           $stmt= Database::getInstance()->prepare($sql); 
           
           
           foreach($arg as $value){


               $stmt->bindParam($value['key'],$value['value']);

           }

               $stmt->execute();
               return $stmt;

       }else{

               $stmt=Database::getInstance()->query($sql);
               return $stmt;

       }
   




}
}
//singleton para evitar multiplos objetos criando conexões ao banco de dados
final class Database
{
    private static ?PDO $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance():PDO
    {
        if(!isset(self::$instance)){
            self::$instance = new PDO("mysql:host=localhost;dbname=teste2","root","");
        }

        return self::$instance;
    }

    

}

