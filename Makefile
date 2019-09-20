.DEFAULT_GOAL := serve

GULP  := $(PWD)/node_modules/.bin/gulp
WPCLI := $(PWD)/dwp

THEME_NAME := md-starter-theme
THEME_DIR  := app/wp-content/themes/$(THEME_NAME)

.PHONY: deps
deps: node_modules $(THEME_DIR)/vendor

node_modules: package.json yarn.lock
	@yarn install
	@touch $@

app/index.php:
	@$(WPCLI) core download --locale=fr_FR --version=5.2.3

app/wp-config.php:
	@$(WPCLI) core config --dbname=wordpress --dbuser=root --dbpass=password --dbhost=mysqldb --locale=fr_FR
	@$(WPCLI) core install --url=localhost:3010 --title=MDstarter --admin_user=admin --admin_password=password --admin_email=admin@md-starter-theme.com --skip-email

$(THEME_DIR)/vendor: $(THEME_DIR)/composer.json $(THEME_DIR)/composer.lock
	@cd $(THEME_DIR); composer install

.PHONY: setup
setup: up_docker deps app/index.php app/wp-config.php
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
up_docker: build_docker
	@HOST_UID=$(shell id -u) HOST_USER=$(shell whoami) docker-compose up -d

.PHONY: serve
serve: deps up_docker ## Run WordPress on localhost:3000 with livereload and phpMyAdmin on localhost:3011
	@$(GULP) --continue

.PHONY: build
build: ## Compile theme assets for production
	@NODE_ENV=production $(GULP)

.PHONY: create_project
create_project: $(THEME_DIR)/vendor
	@cd $(THEME_DIR); composer create_project wp-coding-standards/wpcs:dev-master --no-dev

.PHONY: help
help: ## Print this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
