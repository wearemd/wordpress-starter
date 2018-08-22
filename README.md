# WordPress starter
A starter template for WordPress websites featuring [Docker](https://www.docker.com), Gulp and Webpack.

## Getting started

### Prerequisites
* Node.js -> 8.0.0
* Yarn -> 1.0.0
* Composer -> 1.5.1
* Docker -> 17.12
  * docker-compose -> 1.16.1

### Setup
First rename the `app/wp-content/themes/new-website` folder using your **`theme-name`**.

Then rename every occurence of `new-website` in the entire parent folder (except in `./README.md`) using your **`theme-name`**.

Finally run `make setup` to get everything ready (Docker containers, WordPress files, etc.).

### Serve
`make`
* Starts WordPress on [localhost:3000](http://localhost:3000) with livereload
* Starts phpMyAdmin on [localhost:3011](http://localhost:3011)
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
* `sass`: Theme Sass files (edit those files to update your theme CSS)
  * This theme is built using [Bulma modular CSS framework](https://bulma.io)
