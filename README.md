# WordPress starter
A starter template for WordPress websites featuring Docker, Gulp and Webpack.

## Getting started

### Languages management
First, we highly recommend to use [asdf](https://github.com/asdf-vm/asdf) to manage your languages (Node.js, Ruby and more).

### Prerequisites
* Node.js -> v8.0.0
* Yarn -> 1.0.0
* Composer -> 1.5.1
* Docker -> 17.12
  * docker-compose -> 1.16.1

### Setup
Rename every occurence of `new-website` to `your-theme-name` and run `make setup` to get everything ready (Docker containers, WP files, etc.).

### Serve
`make`
* Starts WordPress on [localhost:3000](http://localhost:3000) with livereload
* Starts phpMyAdmin on [localhost:3011](http://localhost:3011)
* Starts [MailHog](https://github.com/mailhog/MailHog) web interface on [localhost:8025](http://localhost:8025) and SMTP on [localhost:1025](http://localhost:1025)
* Makes WordPress back-office accessible at [localhost:3010/wp-admin](http://localhost:3010/wp-admin)
  * Username: `admin`
  * Password: `password`

## Deployment
**Deployments are made using [Wordmove 3.1.2](https://github.com/welaika/wordmove) and require a recent version of [Ruby](https://www.ruby-lang.org).**

### Setup

```bash
gem install wordmove
```

*Optional:* The following command is required if you use [asdf](https://github.com/asdf-vm/asdf) to manage your languages:

```bash
asdf reshim ruby
```

Then, create a `.env` file at the root of the repo:

```bash
# DB configuration for the production
PROD_DB_NAME=db_name
PROD_DB_USER=db_user
PROD_DB_PASSWORD=db_password
PROD_DB_HOST=db_host
```

To use Wordmove you'll need to access the production server using **SSH** without a password. To achieve that you must copy your public key to the remote server using [ssh-copy-id](https://linux.die.net/man/1/ssh-copy-id):

```bash
ssh-copy-id user@new-website.com
```

Finally you can run `wordmove push --all -e production` for the first deployment.

### Versioning
⚠️ When you update the WordPress theme, don’t forget to **change the theme version number** in `app/wp-content/themes/new-website/style.css` (line 5) before deploying. This version number will append to CSS/JS files to avoid browser cache on those assets.

### Usage
* `make push_production`: Push theme, plugins and languages from local to new-website.com
* `make pull_production`: Pull everything except the theme from new-website.com to local. That way there is no difference between local and production (Database, Uploads, etc.).

## Folders
* `app/wp-content/themes/new-website`: Your new WordPress theme
* `gulp`: Gulp tasks and configuration
* `sass`: Theme Sass files (edit those files to update our theme CSS)
  * This theme is built using [Bulma modular CSS framework](https://bulma.io)
