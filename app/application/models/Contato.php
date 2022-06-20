<?php

    class Contato extends CI_Model {


    public function getCountCo(){
        
        $sql="select count(*) as count from contato";
        
        return $this->connection->query($sql)->fetchAll();
    }
    public function FiltrarPorCpf($cpf,$id=0){

        if($id!=0){
            $where2="AND ID!=:id";
            $arg[]=['key'=>':id',"value"=>$id];
        }else{
            $where2="";
        }

        $sql="SELECT id FROM contato WHERE cpf=:cpf $where2";


        $arg[]=['key'=>':cpf',"value"=>$cpf];

        return $this->connection->query($sql,$arg)->fetchAll();



    }



    public function FiltrarPorEmail($email){

        $arg=[];

        $sql="SELECT id FROM contato WHERE email_contato=:email";
        $arg[]=['key'=>':email',"value"=>$email];

        return $this->connection->query($sql,$arg)->fetchAll();



    }


    
    public function CadastrarContato($dados){

        $arg=[];


        if(isset($dados['id_cliente'])){



            $campo_id_cliente="id_cliente,";
            $valor_id_cliente=":id_cliente,";
            $arg[]=['key'=>':id_cliente',"value"=>$dados['id_cliente']];



        }else{


            $campo_id_cliente="";
            $valor_id_cliente="";


        }


        $arg[]=['key'=>':nome_contato',"value"=>$dados['nome']];
        $arg[]=['key'=>':email_contato',"value"=>$dados['email']];
        $arg[]=['key'=>':cpf',"value"=>$dados['cpf']];

        $sql="INSERT INTO contato($campo_id_cliente nome_contato, email_contato, cpf) VALUES ($valor_id_cliente :nome_contato , :email_contato, :cpf)";

        return $this->connection->query($sql,$arg);


    }



    public function LerContato($id){
        
        
        $sql="SELECT * FROM contato WHERE id=:id";
        $arg[]=['key'=>':id',"value"=>$id];


        return $this->connection->query($sql,$arg)->fetchAll();


    }



    public function AlteraContato($dados){

        $arg=[];

        if(isset($dados['id_cliente'])){


            $campo_id_cliente="id_cliente,";
            $valor_id_valor=":id_cliente,";
            $arg[]=['key'=>':id_cliente',"value"=>$dados['id_cliente']];

            
        }else{
            $campo_id_cliente="";
            $valor_id_valor="";
        }

        $arg[]=['key'=>':id',"value"=>$dados['id']];
        $arg[]=['key'=>':nome_contato',"value"=>$dados['nome']];
        $arg[]=['key'=>':email_contato',"value"=>$dados['email']];
        $arg[]=['key'=>':cpf',"value"=>$dados['cpf']];

        $sql="REPLACE INTO contato(id, $campo_id_cliente nome_contato,email_contato,cpf) values(:id, $valor_id_valor :nome_contato, :email_contato, :cpf)";

        
        return $this->connection->query($sql,$arg);

    }


    public function ContatoScli(){

        $sql="select * from contato where isnull(id_cliente)";
        
        
        return $this->connection->query($sql)->fetchAll();

    }
    public function ExcluirContato($id){


        $sql="DELETE FROM contato WHERE id=:id";
        $arg[]=['key'=>':id',"value"=>$id];


        return $this->connection->query($sql,$arg);

    }
    public function ClienteContato($id){

        $sql="
        SELECT CL.* FROM CLIENTES CL
        INNER JOIN 
        CONTATO CO 
        ON CO.ID_CLIENTE=CL.ID
        WHERE CO.ID=:id
        ";
        
        $arg[]=['key'=>':id',"value"=>$id];
        
        
        return $this->connection->query($sql,$arg)->fetchAll();
    }

    public function ListarContatos($limite=20,$pag=1){
        $arg=[];
        $limite=preg_replace('/[^0-9]/is', '', $limite);
        $pag=preg_replace('/[^0-9]/is', '', $pag);
        if(!is_numeric($limite)||!is_numeric($pag)){
            $limite=20;
            $pag=1;
        }
        if ($pag==1) {

            
            $LIMIT="LIMIT $limite";
           

        } elseif ($pag!=1||$pag>0){

            $PontoPartida=(($pag-1)*$limite);

            $LIMIT="LIMIT $PontoPartida , $limite";
         

        }
       

        $sql="SELECT * FROM contato  $LIMIT";
        
        return $this->connection->query($sql,$arg)->fetchAll();

    }




    





}