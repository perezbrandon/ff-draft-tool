
development: stop
	@docker-compose up -d --remove-orphan

stop:
	@docker-compose stop

ssh:
	@docker exec -it ffdrafttool_web_1 bash

logs:
	@docker logs -f ffdrafttool_web_1
