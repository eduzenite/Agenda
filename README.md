#Instalação

Para que o projeto funcione, será preciso criar uma cópia no arquivo .env.example na raiz do projeto, renomeado para .env e alterando as variáveis do arquivo. Depois, basta rodar os seguintes comandos:

- Instala as dependências
- - composer install
- Roda as migrations do banco
- - php artisan migrate
- Cria um usuário de teste
- - php artisan db:seed
- Teste de carga
- - php artisan db:seed --class=FakerSeeder