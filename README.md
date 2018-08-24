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
**Step 1:** First rename the `app/wp-content/themes/md-starter-theme` folder using your **`theme-name`**.

**Step 2:** Then rename every occurrence of `md-starter-theme` in the parent folder (except in `./README.md`) using your **`theme-name`**.

**Step 3:** You can now edit all informations related to your theme in [`app/wp-content/themes/[theme-name]/style.css`](https://github.com/wearemd/wordpress-starter/blob/master/app/wp-content/themes/md-starter-theme/style.css):

```css
/**
 * Theme Name: MD starter theme
 * Author: MD
 * Author URI: https://wearemd.com
 * Version: 1.0.0
 */

```

**Step 4 *(optional)***: WordPress will be downloaded in french by default. If you want your website to be in another language, set `--locale=fr_FR` in [`Makefile`](https://github.com/wearemd/wordpress-starter/blob/master/Makefile#L17). See the [Complete List of WordPress Locale Codes](https://wpastra.com/docs/complete-list-wordpress-locale-codes/).

**Step 5:** Finally run `make setup` to get everything ready:
- Docker containers
- WordPress download
- WordPress configuration
- Etc.

**Your WordPress is ready to be themed**, well done fella 👊

### Serve
`make`
* Run WordPress on [localhost:3000](http://localhost:3000) with livereload
* Run phpMyAdmin on [localhost:3011](http://localhost:3011)
* Make WordPress back-office accessible at [localhost:3010/wp-admin](http://localhost:3010/wp-admin)
  * Username: `admin`
  * Password: `password`

### Build
`make build_assets`: Build theme assets for production

## Versioning
⚠️ When you update the WordPress theme, don’t forget to **change the theme version number in [`style.css`](https://github.com/wearemd/wordpress-starter/blob/master/app/wp-content/themes/md-starter-theme/style.css#L5) before deploying**. This version number will append to CSS/JS files to bust browser cache on those assets.

## Folders
* `app/wp-content/themes/md-starter-theme`: WordPress theme
* `gulp`: Gulp tasks and configuration
* `sass`: Theme Sass files (edit those files to update your theme CSS)
  * This theme is built using [Bulma modular CSS framework](https://bulma.io)
