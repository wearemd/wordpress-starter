GULP  := $(PWD)/node_modules/.bin/gulp
WPCLI := $(PWD)/bin/dwp

THEME_NAME := md-starter
THEME_DIR  := app/wp-content/themes/$(THEME_NAME)

.PHONY: deps
deps: node_modules $(THEME_DIR)/vendor

node_modules: package.json yarn.lock
	@yarn install
	@touch $@

app/index.php:
	@$(WPCLI) core download --locale=en_US --version=5.3.2

app/wp-config.php:
	@$(WPCLI) core config --dbname=wordpress --dbuser=root --dbpass=password --dbhost=mysqldb --locale=en_US
	@$(WPCLI) core install --url=localhost:3010 --title=md-starter --admin_user=admin --admin_password=password --admin_email=admin@md-starter.com --skip-email

$(THEME_DIR)/vendor: $(THEME_DIR)/composer.json $(THEME_DIR)/composer.lock
	@cd $(THEME_DIR); composer install

.PHONY: create-theme
## Run an interactive prompt to create a new theme
create-theme: node_modules
	@bin/create-theme

## Get everything ready (Docker containers, WordPress download
## and configuration)
.PHONY: setup
setup: up-docker deps app/index.php app/wp-config.php
	@$(WPCLI) theme activate md-starter
	@$(WPCLI) menu create "navbar"
	@$(WPCLI) menu item add-post navbar 2
	@$(WPCLI) menu create "nav_footer"
	@$(WPCLI) menu item add-post nav_footer 2
	@$(WPCLI) rewrite structure '/%year%/%monthnum%/%day%/%postname%/' --hard

.PHONY: build-docker
build-docker: .build-docker.mk

.build-docker.mk: Dockerfile docker-compose.yml
	@sudo HOST_UID=$(shell id -u) HOST_USER=$(shell whoami) docker-compose build
	touch $@

.PHONY: up-docker
up-docker: build-docker
	@HOST_UID=$(shell id -u) HOST_USER=$(shell whoami) docker-compose up -d

.DEFAULT_GOAL := serve
## Serve:
## - WordPress front-office at http://localhost:3000 with live reloading
## - WordPress back-office at http://localhost:3010/wp-admin
##   (username: admin, password: password)
## - phpMyAdmin at http://localhost:3011
.PHONY: serve
serve: deps up-docker
	@$(GULP) --continue

## Build WordPress theme for production use
.PHONY: build
build: deps
	@NODE_ENV=production $(GULP)

.PHONY: install-wpcs
install-wpcs: $(THEME_DIR)/vendor
	@cd $(THEME_DIR); composer create-project wp-coding-standards/wpcs:dev-master --no-dev

.PHONY: clean
clean:
	@docker-compose down
	@sudo git clean -fdX

define primary
\033[38;2;166;204;112;1m$(1)\033[0m
endef

define title
\033[38;2;255;204;102m$(1)\033[0m\n
endef

## List available commands
.PHONY: help
help:
	@printf "$(call primary,wordpress-starter)\n"
	@printf "A starter template for WordPress websites using Make\n\n"
	@printf "$(call title,USAGE)"
	@printf "    make <SUBCOMMAND>\n\n"
	@printf "$(call title,SUBCOMMANDS)"
	@awk '{ \
		line = $$0; \
		while((n = index(line, "http")) > 0) { \
			if (match(line, "https?://[^ ]+")) { \
			  url = substr(line, RSTART, RLENGTH); \
			  sub(url, "\033[38;2;119;168;217m"url"\033[0m", $$0);  \
			  line = substr(line, n + RLENGTH); \
			} else {\
				break; \
			} \
		}\
		\
		if ($$0 ~ /^.PHONY: [a-zA-Z0-9]+$$/) { \
			helpCommand = substr($$0, index($$0, ":") + 2); \
			if (helpMessage) { \
				printf "    $(call primary,%-15s)%s\n", \
					helpCommand, helpMessage; \
				helpMessage = ""; \
			} \
		} else if ($$0 ~ /^[a-zA-Z\-\_0-9.]+:/) { \
			helpCommand = substr($$0, 0, index($$0, ":")); \
			if (helpMessage) { \
				printf "    $(call primary,%-15s)%s\n", \
					helpCommand, helpMessage; \
				helpMessage = ""; \
			} \
		} else if ($$0 ~ /^##/) { \
			if (helpMessage) { \
				helpMessage = helpMessage "\n                   " substr($$0, 3); \
			} else { \
				helpMessage = substr($$0, 3); \
			} \
		} \
	}' \
	$(MAKEFILE_LIST)
