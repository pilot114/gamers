help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  build"
	@echo "  start"
	@echo "  stop"
	@echo "  enter"
	@echo "  npm_dev"
build:
	@docker-compose build
start:
	@docker-compose up -d
stop:
	@docker-compose stop
enter:
	@docker exec -it -u workspace gamers_workspace_1 zsh
npm_dev:
	@docker exec gamers_workspace_1 bash -c 'cd gamers && npm run dev'