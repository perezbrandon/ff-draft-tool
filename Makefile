include .env

development: stop
	@docker-compose up -d --remove-orphan && docker-compose ps

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
