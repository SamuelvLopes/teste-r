<?php
    set_time_limit(0);
    $coon  = new PDO("mysql:host=localhost;dbname=teste2","root","");

        $sql="
            (SELECT CLIENTES.id FROM CLIENTES WHERE status=1)
            EXCEPT 
            (SELECT CONTATO.id_cliente from CONTATO)
        ";

        $stmt=$coon->prepare($sql);

        $stmt->execute();

        foreach($stmt as $linha){
            for ($i = 0; $i <= rand(3,10); $i++) {
               
               
    $dominio=['pratics.com.br','gmail.com','outlook.com','bol.com','gov.br','globo.com','hotmail.com','live.com','yahoo.com'];
    
    $nome=json_decode(file_get_contents('https://randomuser.me/api/?nat=br'),true)['results'][0]['name'];
    
    $nome= $nome['first'].' '.$nome['last']; 



    $dadosParaEnviar = http_build_query(
       [
            'acao' => 'gerar_cpf',
            'pontuacao'=>'N'
            
       ]
    );

    $opcoes = ['http' =>
        [
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $dadosParaEnviar
        ]
        ];

    $contexto = stream_context_create($opcoes);

    $cpf   = file_get_contents('https://www.4devs.com.br/ferramentas_online.php', false, $contexto);

    $email=implode('.',explode(' ',clearId($nome))).'@'.$dominio[rand(0,count($dominio)-1)];
       
    

    $sql="
    INSERT INTO contato(id_cliente,nome_contato, email_contato, cpf) VALUES (:id_cliente,:nome_contato,:email_contato,:cpf)
    ";

    $stmt=$coon->prepare($sql);
    $stmt->bindParam(':id_cliente',$linha['id']);
    $stmt->bindParam(':nome_contato',$nome);
    $stmt->bindParam(':email_contato',$email);
    $stmt->bindParam(':cpf',$cpf);
    $stmt->execute();
    
    echo sha1($cpf.$nome.$email);
   echo '<hr>';
}
    }


        function clearId($id){
            $LetraProibi = Array(",",".","'","\"","&","|","!","#","$","¨","*","(",")","`","´","<",">",";","=","+","§","{","}","[","]","^","~","?","%");
            $special = Array('Á','È','ô','Ç','á','è','Ò','ç','Â','Ë','ò','â','ë','Ø','Ñ','À','Ð','ø','ñ','à','ð','Õ','Å','õ','Ý','å','Í','Ö','ý','Ã','í','ö','ã',
               'Î','Ä','î','Ú','ä','Ì','ú','Æ','ì','Û','æ','Ï','û','ï','Ù','®','É','ù','©','é','Ó','Ü','Þ','Ê','ó','ü','þ','ê','Ô','ß','‘','’','‚','“','”','„');
            $clearspc = Array('a','e','o','c','a','e','o','c','a','e','o','a','e','o','n','a','d','o','n','a','o','o','a','o','y','a','i','o','y','a','i','o','a',
               'i','a','i','u','a','i','u','a','i','u','a','i','u','i','u','','e','u','c','e','o','u','p','e','o','u','b','e','o','b','','','','','','');
            $newId = str_replace($special, $clearspc, $id);
            $newId = str_replace($LetraProibi, "", trim($newId));
            return strtolower($newId);
         }
?>
<head>
  <meta http-equiv="refresh" content="2">
</head>