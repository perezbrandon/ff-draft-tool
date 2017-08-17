
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
