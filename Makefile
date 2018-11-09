help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  build"
	@echo "  start"
	@echo "  stop"
	@echo "  enter"
	@echo "  gen-entities"
	@echo "  sync-schema"
	@echo "  drop-schema"
build:
	@docker-compose build
start:
	@docker-compose up -d
stop:
	@docker-compose stop
enter:
	@docker exec -it -u workspace gamers_workspace_1 zsh

# in workspace
gen-entities:
	@vendor/bin/doctrine orm:generate-entities src
sync-schema:
	@vendor/bin/doctrine orm:schema-tool:update --force
drop-schema:
	@vendor/bin/doctrine orm:schema-tool:drop --force
