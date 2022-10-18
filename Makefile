.PHONY: help
help:
	@fgrep -h "##" $(MAKEFILE_LIST) | sed -e 's/\(\:.*\#\#\)/\:\ /' | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

.PHONY: cs-fix
cs-fix: ## Run cs-fixer
	docker compose run app vendor/bin/php-cs-fixer fix --show-progress=dots

.PHONY: cs-fix-check
cs-fix-check: ## Run cs-fixer
	docker compose run app vendor/bin/php-cs-fixer fix --show-progress=dots --dry-run

.PHONY: server-start
server-start: ## Start server
	docker compose up -d

.PHONY: server-stop
server-stop: ## Start server
	docker compose down

.PHONY: server-console
server-console: ## Exec server bin/console
	docker compose exec -it app bin/console

.PHONY: server-shell
server-shell: ## Exec server console
	docker compose exec -it app sh

.PHONY: composer-install
composer-install: ## Install composer dependencies
	docker compose exec -it app composer install

.PHONY: composer-update
composer-update: ## Update composer dependencies
	docker compose exec -it app composer update

.PHONY: database-migrations-migrate
database-migrations-migrate: ## Migrate migrations
	docker compose exec -it app bin/console doctrine:migrations:migrate --no-interaction

.PHONY: database-migrations-diff
database-migrations-diff: ## Create migration based on database <-> entities diff
	docker compose exec -it app bin/console doctrine:migrations:diff --no-interaction

.PHONY: database-drop
database-drop: ## Drop database
	docker compose exec -it app bin/console doctrine:database:drop --force

.PHONY: database-create
database-create: ## Create database
	docker compose exec -it app bin/console doctrine:database:create
