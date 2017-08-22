include .env

repl:
	@docker-compose run --rm php_cli php\ artisan\ tinker

development: stop
	@docker-compose up -d --remove-orphan && open http://localhost:$(PORT)

status:
	@docker-compose ps

stop:
	@docker-compose stop

ssh:
	@docker exec -it ffdrafttool_web_1 bash

logs:
	@docker logs -f ffdrafttool_web_1

build:
	@docker-compose build web

mysql:
	@mysql -h 127.0.0.1 -P 3308 -u root --password=$(DB_PASSWORD)

create-dbs:
	@mysql -h 127.0.0.1 -P 3308 -u root --password=$(DB_PASSWORD) -e "CREATE DATABASE IF NOT EXISTS ff_draft_tool_dev; CREATE DATABASE IF NOT EXISTS ff_draft_tool_test;"

test:
	@docker-compose run --rm php_cli vendor/bin/phpunit-watcher\ watch

migrate:
	@docker-compose run --rm -e DB_DATABASE=ff_draft_tool_dev php_cli php\ artisan\ migrate && \
	docker-compose run --rm -e DB_DATABASE=ff_draft_tool_test php_cli php\ artisan\ migrate

rollback-migrate:
	@docker-compose run --rm -e DB_DATABASE=ff_draft_tool_dev php_cli php\ artisan\ migrate:refresh&& \
	docker-compose run --rm -e DB_DATABASE=ff_draft_tool_test php_cli php\ artisan\ migrate:refresh
