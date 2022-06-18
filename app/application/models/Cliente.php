<?php

    class Cliente extends CI_Model {
    public function DeleteCliente($id){

        $sql="
        DELETE clientes,contato FROM clientes
        INNER JOIN contato ON clientes.id = contato.id_cliente OR clientes.status=0 where clientes.id=:id
        ";
        
        $arg=[];
        $arg[]=['key'=>':id',"value"=>$id];
        return $this->connection->query($sql,$arg);
    }
    public function UpdateCliente($dados){

        $sql="
        REPLACE INTO clientes(id, nome, cnpj,status) values(:id, :nome,:cnpj,:status)
        ";

        $arg=[];
        $arg[]=['key'=>':id',"value"=>$dados['id']];
        $arg[]=['key'=>':nome',"value"=>$dados['nome']];
        $arg[]=['key'=>':cnpj',"value"=>$dados['cnpj']];
        $arg[]=['key'=>':status',"value"=>$dados['status']];

        return $this->connection->query($sql,$arg);

    }
    public function CadastrarCliente($dados){
        
            $sql="
            INSERT INTO clientes(nome, cnpj, status) VALUES (:nome,:cnpj,:status)
            ";
            $arg=[];
            $arg[]=['key'=>':nome',"value"=>$dados['nome']];
            $arg[]=['key'=>':cnpj',"value"=>$dados['cnpj']];
            $arg[]=['key'=>':status',"value"=>$dados['status']];

            return $this->connection->query($sql,$arg);
        

    }

    public function FiltrarPorId($id){

        $sql="SELECT * FROM CLIENTES WHERE CLIENTES.id=:id";

        $arg=[];
        $arg[]=['key'=>':id',"value"=>$id];

        return $this->connection->query($sql,$arg)->fetchAll();

    }

    public function FiltrarPorCnpj($cnpj,$id=0){
        $arg=[];

        if($id!=0){

            $where2="and id!=:id";
            $arg[]=['key'=>':id',"value"=>$id];

        }else{
            $where2="";
        }

        $sql="SELECT * FROM CLIENTES WHERE CLIENTES.cnpj=:cnpj $where2";
        
        $arg[]=['key'=>':cnpj',"value"=>$cnpj];

        return $this->connection->query($sql,$arg)->fetchAll();

    }

    public function ProcuraPorCnpj($cnpj){

        $sql="SELECT * FROM CLIENTES WHERE CLIENTES.cnpj like :cnpj";

        $arg=[];
        $arg[]=['key'=>':cnpj',"value"=>'%'.$cnpj.'%'];

        return $this->connection->query($sql,$arg)->fetchAll();

    }

    public function ListarContatos($id){

        $sql='SELECT * FROM CONTATO WHERE ID_CLIENTE=:id';
        $arg=[];
        $arg[]=['key'=>':id',"value"=>$id];

        return $this->connection->query($sql,$arg)->fetchAll();

    }
    public function ListarClientes($ativo=2,$limite=20,$pag=1){
        $arg=[];
        $limite=preg_replace('/[^0-9]/is', '', $limite);
        $pag=preg_replace('/[^0-9]/is', '', $pag);
        $ativo=preg_replace('/[^0-9]/is', '', $ativo);
        if(!is_numeric($limite)||!is_numeric($pag)||!is_numeric($ativo)){
            $limite=20;
            $pag=1;
            $ativo=2;
        }
        if ($pag==1) {

            
            $LIMIT="LIMIT $limite";
           

        } elseif ($pag!=1||$pag>0){

            $PontoPartida=(($pag-1)*$limite);

            $LIMIT="LIMIT $PontoPartida , $limite";
         

        }
        if($ativo==2){

            $WHERE="";
        
        }else{

            $WHERE="WHERE status=:ativo";
            $arg[]=['key'=>':ativo',"value"=>$ativo];
        }

        $sql="SELECT * FROM clientes $WHERE $LIMIT";
        
        return $this->connection->query($sql,$arg)->fetchAll();

    }


}