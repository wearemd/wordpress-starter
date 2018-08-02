# Template for WP website
This README itemizes everything is required to work on WordPress website:
* Livereload
* Sass compilation
* phpMyAdmin
* Deployments

- - -

## Getting started

### Prerequisites
* Node.js -> v8.0.0
* Yarn -> 1.0.0
* Gulp -> 3.9.1
* Composer -> 1.5.1
* Docker -> 17.12
  * docker-compose -> 1.16.1

### Setup
Rename every occurence of `new-website` to `your-theme-name` and run `make setup` to get everything ready (Docker containers, WP files, etc.).

### Serve
`make`
* Starts WordPress on [localhost:3000](http://localhost:3000) with livereload
* Starts phpMyAdmin on [localhost:3011](http://localhost:3011)
* Makes WordPress back-office accessible at [localhost:3010/wp-admin](http://localhost:3010/wp-admin)
  * Username: `admin`
  * Password: `password`

- - -

## Deployment
**Deployments are made using [Wordmove 3.1.2](https://github.com/welaika/wordmove) and require a recent version of [Ruby](https://www.ruby-lang.org).**

### Installation

```bash
gem install wordmove
# asdf command is required if you use https://github.com/asdf-vm/asdf to manage your languages 
asdf reshim ruby
```

### Configuration
Create a `.env` file:

```
# DB configuration for the production
PROD_DB_NAME=db_name
PROD_DB_USER=db_user
PROD_DB_PASSWORD=db_password
PROD_DB_HOST=db_host
```

### Versioning
⚠️ When you update the WordPress theme, don’t forget to **change the theme version number** in `app/wp-content/themes/new-website/style.css` (line 5) before deploying. This version number will append to CSS/JS files to avoid browser cache on those assets.

### Usage
Assuming that you have a server with everything installed (MySQL, SSH, etc.) you'll just have to run `make push_production`. Then after the first deployment you'll have to create a `wp-config.php` file on your server with the settings corresponding to your installation.

- - -

## Folders
* `app/wp-content/themes/new-website`: Your new WordPress theme
* `gulp`: Gulp tasks and configuration
* `sass`: Theme Sass files (edit those files to update our theme CSS)
  * This theme is built using [Bulma modular CSS framework](https://bulma.io)
