## Conf Registration Landing App

### Before Start

For deploying the app, following tools are must be installed in your system:

- [Docker Engine](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

For some comfort use, add to end of your system host file (/etc/hosts) test domain:

```bash
# App test domain for local deploy
127.0.0.1 conflandtask.test
```

As laravel is use its own env file, let's copy and rename existing **.env.example** in **./src** folder to **.env**. It's easy with console:

```bash
cp src/.env.example src/.env
```

The App can send email for users, but for testing, it's using a email interceptor service - [mailtrap.io](https://mailtrap.io/). It's free, easy to use service with quick registration process. Once after you get registred on this service, you can acceess to ***Demo Inbox***. Click on it and choose "Laravel 7+" in integration dropdown list. After you've get a ***MAIL_USERNAME*** and ***MAIL_PASSWORD*** credentials, pass them into your Laraval **.env** file as a same variables. 

---
### All ok, ready to start
For starting app follow these steps:

1. For build a containers and start them in "silent" mode type in console following commands:
```bash
docker-compose build && docker-compose up -d
```
2. For install Laravel packages by Composer, you need to enter to container with PHP. Type in console `docker exec -it conflandtask_php bash` and after that type `composer install`
3. Install npm packages for frontend and compile js and css production files:
```bash
docker-compose run --rm node ci # install npm packages based on lock-file
docker-compose run --rm node run prod # compile CSS an JS by Laravel-Mix
```

<!-- For exit from container, just type `exit` in console -->