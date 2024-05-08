current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

UID=$(shell id -u)
GID=$(shell id -g)

define DOCKER_COMPOSE
	UID=$(UID) GID=$(GID) docker compose
endef

##@ Commands
help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)
.PHONY: help

composer-install: ## Runs composer install in workdir
	$(DOCKER_COMPOSE) exec php composer install
.PHONY: composer-install
composer-update: ## Runs composer update in workdir
	$(DOCKER_COMPOSE) exec php composer update
.PHONY: composer-update

composer: ## Runs an generic composer command passing as arguments. Ex: make `composer cmd="test"`
	$(DOCKER_COMPOSE) exec php composer ${cmd}
.PHONY: composer

start: ## Build and start the container
	$(DOCKER_COMPOSE) up --build -d
.PHONY: start

test: ## Run tests
	$(DOCKER_COMPOSE) exec bling composer test
.PHONY: start

stop: ## Stop the container
	$(DOCKER_COMPOSE) stop
.PHONY: stop

destroy: ## Destroy the container
	$(DOCKER_COMPOSE) down
.PHONY: destroy

rebuild: ## Rebuild the container
	$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make install
	make start
.PHONY: rebuild