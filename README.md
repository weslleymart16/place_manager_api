<h1 align="center">Projeto Laravel - Gerenciador de lugares</h1>

Este é um projeto Laravel que utiliza Laravel Sail para gerenciar o ambiente de desenvolvimento local. O projeto utiliza PHP 8.1 e um banco de dados PostgreSQL.

Obs. Caso queria visualizar registro no banco de dados usar rota `localhost/adminer.php` e usar credenciais do .env

Configuração do Ambiente

### Instalação

1 - Clone este repositório para o seu ambiente local; <br>
2 - Abra o docker desktop;<br>
3 - Copie o arquivo .env.example para .env;<br>
4 - Inicie os containers do Laravel Sail:<br>
<br>`sail up -d`<br><br>
5 - Gere chave artisan 
<br>`sail php artisan key:generate`<br><br>
6 - Execute o comando :<br>
<br>`sail php artisan migrate` <br><br>

A aplicação estará disponível em http://localhost.

### Endpoints da API
A API oferece os seguintes endpoints:

• Criar um lugar
• Editar um lugar
• Obter um lugar específico
• Listar lugares e filtrá-los por nome

## Arquivo Postman Collection

Este projeto inclui um arquivo JSON chamado `place_manager.postman_collection.json`, que contém uma coleção do Postman com exemplos de requisições para as rotas da API deste projeto.

Este arquivo é útil para testar as rotas da API localmente ou para compartilhar com outras pessoas que desejam interagir com a API sem a necessidade de configurar manualmente as requisições.

### Testes Unitários

Execute os testes unitários com o seguinte comando:
`sail php artisan test`
