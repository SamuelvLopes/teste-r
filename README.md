# desafio-r
## acesso externo
https://teste-r.pratics.com.br/

## obs
- pattern Singleton(desafio-r/app/application/libraries/Connection.php) e MVC(projeto)
- lib de idioma(pt|en)-https://teste-r.pratics.com.br/?lang=en
- Desenvolvido utilizando como base o conceito de API R, a aplicação se comunica de forma totalmente a parte
- Consumo de API externas para popular o banco


## Modelo do Banco
![png](https://user-images.githubusercontent.com/51290633/174152549-5ae94051-7e3e-4a57-b100-eb381916c1bb.png)

## Modelo do banco com as relações em destaque
![image](https://user-images.githubusercontent.com/51290633/174152516-a3bcca2d-6639-477c-97ea-b4b15f913312.png)




## Codeignetor 3 será utilizado apenas para geração da Estrutura MVC 
### instruções
Implementar um CRUD com 2 tabelas relacionadas, utilizando PHP, MySql e Javascript/JQuery.

 

- Utilize seu conhecimento da forma que desejar, ficando livre a forma de desenvolver. Evite usar frameworks que abstraiam muito.

- Use SQL para interação com o banco de dados

- Se achar necessário explicar algo, deixe comentário em alguma parte do código.

 

Gostaríamos de um retorno até segunda-feira, em qualquer horário, do que você já tenha

conseguido desenvolver. Podemos estender este prazo se você julgar necessário.

 

 

 

Implementação

------------------------------------------------------

Desenvolver um CRUD para duas tabelas listadas abaixo.

Métodos para Incluir, Alterar e Excluir.

Listar cadastro em forma de tabela

 

Tabelas

-----------------------------------------------------

Clientes

   id INT AUTOINCREMENT

   nome VARCHAR

   cnpj CHAR(14)

   status ( 0 inativo ou 1 ativo )

 

Contatos dos clientes

   id INT AUTOINCREMENT

   id_cliente INT

   nome_contato VARCHAR

   email_contato VARCHAR

   cpf CHAR(11)

  

As duas tabelas se relacionam : contatos.id_cliente = clientes.id

 

Expectativa:

 

   Tela com lista e filtro de clientes

   Botões para incluir, alterar ou excluir clientes

      Inclusão/Exclusão: Formulário para preenchimento com máscara de CNPJ

                         Não permitir CNPJ duplicado.

   Ao excluir um cliente, excluir primeiro seus contatos.

 

   Tela com lista de contatos do cliente

   Máscara do CPF

   Validação de e-mail preenchido corretamente

   Botões para incluir, alterar ou excluir contatos

      Inclusão/Exclusão: Formulário para preenchimento com máscara de CPF e

                         validação de e-mail preenchido corretamente.

 

Quaisquer dúvidas, pode retornar neste e-mail.

 

Atenciosamente,
