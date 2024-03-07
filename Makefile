DC=docker-compose
DCEXEC=docker exec
APP=app
COMPOSER=${DCEXEC} ${APP} composer

init: up migration seed

up:
	${DC} up -d --build

down:
	${DC} down

migration:
	${DCEXEC} ${APP} php artisan migrate

seed:
	${DCEXEC} ${APP} php artisan db:seed




