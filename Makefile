dev.up:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml up -d --scale php=10

dev.down:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml down

dev.hooks:
	git config core.hooksPath .githooks

dev.build:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml build

dev.restart:
	docker-compose -f docker/docker-compose.yml -f docker/docker-compose.dev.yml restart

dev.cache:
	docker-compose -f docker/docker-compose.yml exec bin/console cache:clear
	docker-compose -f docker/docker-compose.yml exec bin/console cache:warmup

composer.install:
	docker-compose -f docker/docker-compose.yml exec --user=1000 php composer install

composer.update:
	docker-compose -f docker/docker-compose.yml exec --user=1000 php composer update

symfony.ready: composer.install
	docker-compose -f docker/docker-compose.yml exec --user=1000 php bin/console doctrine:cache:clear-metadata
	docker-compose -f docker/docker-compose.yml exec --user=1000 php bin/console doctrine:cache:clear-query
	docker-compose -f docker/docker-compose.yml exec --user=1000 php bin/console doctrine:cache:clear-result
	docker-compose -f docker/docker-compose.yml exec --user=1000 php bin/console doctrine:migrations:migrate -n

symfony.fixtures.load:
	docker-compose -f docker/docker-compose.yml exec --user=1000 php bin/console doctrine:fixtures:load

prod.up:
	docker-compose -f docker/docker-compose.yml up -d --scale php=10
	make composer.install

prod.down:
	docker-compose -f docker/docker-compose.yml down

prod.build:
	docker-compose -f docker/docker-compose.yml build

prod.restart:
	docker-compose -f docker/docker-compose.yml restart

prod.cache:
	docker-compose -f docker/docker-compose.yml exec --user=1000 bin/console cache:clear --env=prod --no-debug
	docker-compose -f docker/docker-compose.yml exec --user=1000 bin/console cache:warmup --env=prod --no-debug