# WordPress starter
A starter template for WordPress websites featuring Docker, Gulp and Webpack.

## Getting started

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

### Build
`make build_assets`: Build theme assets for production

## Versioning
⚠️ When you update the WordPress theme, don’t forget to **change the theme version number** in `app/wp-content/themes/new-website/style.css` (line 5) before deploying. This version number will append to CSS/JS files to avoid browser cache on those assets.

## Folders
* `app/wp-content/themes/new-website`: Your new WordPress theme
* `gulp`: Gulp tasks and configuration
* `sass`: Theme Sass files (edit those files to update our theme CSS)
  * This theme is built using [Bulma modular CSS framework](https://bulma.io)
