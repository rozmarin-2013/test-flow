This is simple news article api, complete with MySQL database, PHP API.

This API was created with Laravel 10.

### To deploy the project follow these steps:
1. Clone repositorium:
```sh
$ git clone https://github.com/rozmarin-2013/test-flow/tree/meczyki
```

2. change branch to meczyki
```sh
$ git checkout meczyki
```

3. For init project, please run (this command will create docker containers, install all composer packages, run migrations 
and seeds, create swager documentation):
```sh
$ make init
```
4. The api will be available via the link http://localhost:8989/
5. Swagger documentation with all available endpoints is on page http://localhost:8989/api/documentation#/default/76b7d2f1c8f503e19a196c9d16783451
###

To run the project later, run the command
```sh
$ make up
```

To down project
```sh
$ make down
```

To run composer install
```sh
$ make composer-install
```

To regenerate swagger documentation
```sh
$ make swagger
```
To run migration
```sh
$ make migration
```

To run seed
```sh
$ make seed
```

To run cs-fix:
```sh
$ make cs-fix
```
