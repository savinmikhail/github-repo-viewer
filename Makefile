.PHONY: build
build:
	sudo docker compose build

.PHONY: up
up:
	sudo docker compose up -d

.PHONY: down
down:
	sudo docker compose down


.PHONY: ps
ps:
	sudo docker compose ps

.PHONY: bash
bash:
	sudo docker compose exec php-fpm bash

.PHONY: db
db:
	sudo docker compose exec db bash && mysql -u dbuser -p

.PHONY: restart
restart:
	sudo docker compose down && sudo docker compose build && sudo docker compose up -d

.PHONY: start
start:
	sudo docker compose build && sudo docker compose up -d

.PHONY: migrate
migrate:
	docker compose exec php-fpm php artisan migrate

 .PHONY: seed
seed:
	docker compose exec php-fpm php artisan db:seed
