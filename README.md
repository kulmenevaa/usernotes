## Инициализация

#### Установка и настройка проекта на локальном компьютере
В скопированном файле необходимо указать:
+ параметры подключения к базе данных
+ параметры подключения к smtp серверу почты
+ указать данные администратора в полях ADMIN_EMAIL и ADMIN_PASSWORD <br/>
#### Точкой входа для приложения служит файл public/index.php
```bash
$ git clone https://github.com/kulmenevaa/usernotes
$ cd usernotes
$ cp .env .env.example
$ composer install
$ php artisan key:generate
$ npm install && npm run prod
```

Запуск миграции структуры БД и наполнение тестовыми данными
```bash
$ php artisan migrate --seed
```

Создание ключей шифрования для авторизации
```bash
$ php artisan passport:install
```

#### Ссылка на документацию API: /api/documentation
