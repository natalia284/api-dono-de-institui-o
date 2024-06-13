# :office: API de Cadastro de Clientes e Instituições
O projeto desenvolvido em Laravel consiste em uma API com endpoints para cadastrar, editar, ler e excluir clientes e instiuições associadas aos clientes. 

# :anchor: Endpoints 
Os endpoints do projeto se encontram em `routes/api.php`. Você pode utilizar o Postman para consumir a API. 

# :gear: Configuração
A instalação da API está descrita a seguir: 
```bash
# Instalando as dependẽncias usando o Composer
composer install

# Na pasta /database crie o banco de dados SQLite
touch banco.sqlite

# Em seguida, crie as migrations utilizando o artisan
php artisan migrate

# Inicie o servidor na porta 8080
php artisan serve --port=8080
```
