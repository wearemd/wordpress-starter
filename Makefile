GULP  := $(PWD)/node_modules/.bin/gulp
WPCLI := $(PWD)/dwp

THEME_NAME := md-starter-theme
THEME_DIR  := app/wp-content/themes/$(THEME_NAME)

.PHONY: deps
deps: node_modules $(THEME_DIR)/vendor ## Install/update dependencies

node_modules: package.json yarn.lock
	@yarn install
	touch $@

app/index.php:
	@$(WPCLI) core download --locale=fr_FR --version=4.9.8

app/wp-config.php:
	@$(WPCLI) core config --dbname=wordpress --dbuser=root --dbpass=password --dbhost=mysqldb --locale=fr_FR
	@$(WPCLI) core install --url=localhost:3010 --title=MDstarter --admin_user=admin --admin_password=password --admin_email=admin@md-starter-theme.com --skip-email

$(THEME_DIR)/vendor: $(THEME_DIR)/composer.json $(THEME_DIR)/composer.lock
	@cd $(THEME_DIR); composer install

.PHONY: setup
setup: up_docker deps app/index.php app/wp-config.php ## Setup everything required to work on this WordPress installation
	@$(WPCLI) theme activate md-starter-theme
	@$(WPCLI) menu create "navbar"
	@$(WPCLI) menu item add-post navbar 2
	@$(WPCLI) menu create "navbar_footer"
	@$(WPCLI) menu item add-post navbar_footer 2
	@$(WPCLI) rewrite structure '/%year%/%monthnum%/%day%/%postname%/' --hard

.PHONY: build_docker
build_docker: .build_docker.mk

.build_docker.mk: Dockerfile docker-compose.yml
	@sudo HOST_UID=$(shell id -u) HOST_USER=$(shell whoami) docker-compose build
	touch $@

.PHONY: up_docker
up_docker: build_docker ## Run WordPress on localhost:3010 and phpMyAdmin on localhost:3011
	@HOST_UID=$(shell id -u) HOST_USER=$(shell whoami) docker-compose up -d

.DEFAULT_GOAL := dev
.PHONY: dev
dev: deps up_docker ## Run WordPress on localhost:3000 with livereload
	@$(GULP) --continue

.PHONY: build_assets
build_assets: ## Compile theme assets for production
	@NODE_ENV=production $(GULP)

.PHONY: help
help: ## Print this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

create-project: $(THEME_DIR)/composer.json
	@cd $(THEME_DIR); composer update; composer create-project wp-coding-standards/wpcs:dev-master --no-dev
