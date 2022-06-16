<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
class Connection{

    public function __construct() {
       echo'pao';
    }

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

