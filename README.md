# LOJA VIRTUAL em Yii2 Framework


Projeto desenvolvido no framework Yii2, linguagem PHP.

Tecnologias utilizadas:

- [PHP 7.1](https://www.php.net/)
- [Apache 2](https://httpd.apache.org/download.cgi)
- [Yii2 Framework](https://www.yiiframework.com/download)
- [NPM JS](https://www.npmjs.com/)
- [jQuery](https://code.jquery.com/)
- [Bootstrap](https://getbootstrap.com/)
- [Composer](https://getcomposer.org/)
- [Grunt](https://gruntjs.com/)
- [Krakee Fileinput](https://plugins.krajee.com/file-input)
- [Krajee Select2](https://demos.krajee.com/widget-details/select2) 
- [Testes com Codeception](https://codeception.com/)
- [MySQL](https://www.mysql.com/downloads/)  
- [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)


Descrição do Projeto
---

O projeto consiste numa Loja Virtual construída com o Yii2 Framework. O sistema possui as seguintes características:

- Criação de usuário
- Frontend com login de perfil de Usuário e Admin
- Listagem de produtos por Categoria
- Exibição de produto com listagem de fotos via plugin Bootstrap Carousel
- Adicionar produto no carrinho via Ajax
- Exibição do carrinho de compras com produtos adicionados, preços, quantidade e valor total
- Finalização somente com usuário logado
- COntrole de estoque do produto
- Backend com login somente permitido para Admin
- CRUD de Categorias
- CRUD de Produtos
- Exibição de Pedidos com produtos adicionados, preços, quantidade e valor total
- Deleção de pedidos
- Exibição e Deleção de Usuários

 

Instruções para Instalação
--
No seu diretório localhost, execute o comando:

```
$ git clone git@github.com:juniorari/yii2-loja-virtual.git
```
Acessar o diretório

```
$ cd yii2-loja-virtual/
```
Executar o comando, para criar os arquivos necessários do Yii, e selecione o ambiente Development:
```
$ php init
```

Baixar as dependências:
```
$ composer install
$ npm install
```

Criar um Banco de Dados MySQL e alterar o acesso no arquivo:
```
common\config\main-local.php
```
```
'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2-loja-virtual',
    'username' => 'XXXXXXXXXXX',
    'password' => 'XXXXXXXXXXX',
    'charset' => 'utf8',
],
```

Rodar as migrations:
```
$ php yii migrate
```

Executar o grunt para gerar o JS minificado:
```
$ grunt
```

OBS: Caso não tenha o **grunt** instalado, siga as instruções [aqui](https://gruntjs.com/getting-started)

Dar permissão de leitura e escrita para a pasta **frontend/web/uploads/produtos/**
```
$ sudo chmod -R 777 frontend/web/uploads/produtos/
```

Pronto!! A loja já destá funcionando :-) !!

Para acessar como Usuário: [http://localhost/yii2-loja-virtual/](http://localhost/yii2-loja-virtual/)</b>


```
Usuário: usuario
Senha: user123
```



Para acessar como Admin: [http://localhost/yii2-loja-virtual/admin/](http://localhost/yii2-loja-virtual/admin)</b>

```
Usuário: admin
Senha: admin123
```

OBS: Não foi implementado os meios de pagamento, por motivos óbvios.

Está disponível também o arquivo **yii2-loja-virtual.mwb**, referente ao model do banco de dados, para uso com o [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)

Realizando Testes com Codeception
----

* Atualizar ou alterar o parâmetro **url** no arquivo **tests/acceptance.suite.yml**, de acordo com a URL do site. Ex: **http://localhost/yii2-loja-virtual**
```
actor: AcceptanceTester
modules:
    enabled:
        - PhpBrowser:
            url: http://localhost/yii2-loja-virtual
        - \Helper\Acceptance
```
* Executar os testes:
```
$ php vendor/bin/codecept run
```



Dúvidas? Fique à vontade!
