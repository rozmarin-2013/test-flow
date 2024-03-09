DC=docker-compose
DCEXEC=docker exec
APP=app
COMPOSER=${DCEXEC} ${APP} composer

init: up composer-install migration seed swagger

up:
	${DC} up -d --build

down:
	${DC} down

migration:
	${DCEXEC} ${APP} php artisan migrate

seed:
	${DCEXEC} ${APP} php artisan db:seed

composer-install:
	${COMPOSER} install --no-progress

swagger:
	${DCEXEC} ${APP} php artisan l5-swagger:generate

cs-fix:
	${DCEXEC} ${APP} composer phpcs

