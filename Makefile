dev.up:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml -p libraryapp up -d

dev.down:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml -p libraryapp down

dev.hooks:
	git config core.hooksPath .githooks

dev.build:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml -p libraryapp build

dev.restart:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml -p libraryapp restart

dev.cache:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console cache:clear
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console cache:warmup
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:cache:clear-metadata
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:cache:clear-result
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:cache:clear-query

dev.fixtures.load:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:fixtures:load -n

dev.database.reset:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:database:drop --force
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:database:create
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:migrations:migrate -n
	docker-compose -f docker/docker-compose.yml -p libraryapp exec php bin/console doctrine:fixtures:load -n

composer.install:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php composer install

composer.update:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php composer update

symfony.ready: composer.install
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console doctrine:cache:clear-metadata
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console doctrine:cache:clear-query
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console doctrine:cache:clear-result
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console doctrine:migrations:migrate -n

symfony.fixtures.load:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console doctrine:fixtures:load

prod.up:
	docker-compose -f docker/docker-compose.yml -p libraryapp up -d --scale php=2
	make composer.install
	make symfony.ready

prod.down:
	docker-compose -f docker/docker-compose.yml -p libraryapp down

prod.build:
	docker-compose -f docker/docker-compose.yml -p libraryapp build

prod.restart:
	docker-compose -f docker/docker-compose.yml -p libraryapp restart

prod.cache:
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console cache:clear --env=prod --no-debug
	docker-compose -f docker/docker-compose.yml -p libraryapp exec --user=1000 php bin/console cache:warmup --env=prod --no-debug