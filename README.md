# Instalação

Para que o projeto funcione, será preciso criar uma cópia no arquivo .env.example na raiz do projeto, renomeado para .env e alterando as variáveis do arquivo. Nesse arquivo será necessário alterar as informações do banco de dados.

Depois, basta rodar os seguintes comandos:

- Instala as dependências
- - composer install
- Roda as migrations do banco
- - php artisan migrate
- Cria um usuário de teste
- - php artisan db:seed
- Teste de carga
- - php artisan db:seed --class=FakerSeeder

Com isso o projeto deverá estar rodando na sua máquina. Para rodar o server do Laravel e ver tudo funcionando, basta rodar o seguinte comando:

php artisan serve