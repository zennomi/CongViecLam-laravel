## Notice

Adminlte v3.1.0
Laravel v8.12

# How to setup project in localhost ?
- Clone your project
- Go to the folder application using cd command on your cmd or terminal
- Run composer install on your cmd or terminal
- Run npm install or yarn install then run npm run dev or yarn dev
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- Run php artisan key:generate
- Run sudo service mysql start
- Run php artisan migrate --seed
- Run php artisan serve
- Go to http://localhost:8000/
