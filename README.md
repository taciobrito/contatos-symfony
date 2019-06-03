# Teste de contatos e endereços

# Introdução

Conforme requisitado para o desenvolvimento deste projeto, o mesmo foi feito com as tecnologias Symfony, Doctrine (ORM), Twig (template tags) e AngularJS.

# Start

Para inicializar o projeto, siga os passos abaixo:

1º - É necessário realizar o clone do repositório em: https://github.com/taciobrito/contatos-symfony.

2º - Localizando via terminal, o diretório do projeto clonado, execute o comando **composer install**

3º - Procure pelo arquivo **.env** na raíz do projeto, caso não possuo, crie um e configure-o como mostra o exemplo abaixo:

```
	APP_ENV=dev
	APP_SECRET=e7d54dfdc61b65c4da2a92903db5f015
	DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

Em que o **DATABSE_URL** é conforme a conexão mysql na máquina local.

4º - Depois, crie o banco de dados utilizando o comando:

```
	php bin/console doctrine:database:create
```

5º - Após o banco de dados criado, execute a(s) migration(s) para criação das tabelas:

```
	php bin/console doctrine:migrations:migrate
```

6º - Pronto, agora basta rodar o projeto conforme o comando a seguir, passando a porta que desejar:

```
	php bin/console server:run localhost:8003
```

E abra a URL no navegador.

OBS: caso a porta configurada seja diferente da **8003**, será necessário que mude no arquivo **/public/js/main.js**, linha 4, a variável **appurl**.

