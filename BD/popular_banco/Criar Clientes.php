<?php

    $dadosParaEnviar = http_build_query(
        array(
            'acao' => 'gerar_cnpj',
            'pontuacao'=>'N'
            
        )
    );

    $opcoes = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $dadosParaEnviar
        )
    );

    $contexto = stream_context_create($opcoes);

    $cnpj   = file_get_contents('https://www.4devs.com.br/ferramentas_online.php', false, $contexto);

    $tipo=['LTDA','ME','EIRELI','MEI'];

    $nome=json_decode(file_get_contents('https://randomuser.me/api/?nat=us'),true)['results'][0]['location'];

    $nome= $nome['street']['name'].' '.$nome['city'].' '.$tipo[rand(0,count($tipo)-1)];
    $ativo=rand(0,1);


    $coon  = new PDO("mysql:host=localhost;dbname=teste2","root","");

    $sql="
     INSERT INTO clientes (nome, cnpj, status) VALUES (:nome,:cnpj,:status)
     ";

  $stmt=$coon->prepare($sql);

  $stmt->bindParam(':nome',$nome);
  $stmt->bindParam(':cnpj',$cnpj);
  $stmt->bindParam(':status',$ativo);
  $stmt->execute();
?>