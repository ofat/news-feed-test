# News feed test application on Symfony

This repository is my test task as a part of interviewing in some company

### Technologies

- Symfony 5.3
- Mysql
- Vue.js 2
- Tailwind

Developed news list with translations (french & english lang supported) 
and possibility to comment.

For language switcher implemented Strategy pattern in TranslateUrl service.

Comments made with vue.js

All theming and styles made with Tailwind CSS.

### Installation

- Clone repository
```shell
git clone https://github.com/ofat/news-feed-test
```
- Go to project and install all composer dependencies:

```shell
cd news-feed-test && composer install
```

- Copy .env file to your .env.local and fill database settings

- Run migrations

```shell
php bin/console doctrine:migrations:migrate
```

- Load fixtures

```shell
php bin/console doctrine:fixtures:load
```

- Run your local server

```shell
symfony serve
```

- Open in browser http://localhost:8000/