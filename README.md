<h1 align="center">WordPress starter</h1>
<p align="center"><strong>WordPress starter</strong> is a starter template for WordPress websites.</p>

## ⚙️ Prerequisites
- [**asdf**](https://github.com/asdf-vm/asdf)
- [**Composer**](https://getcomposer.org)
- [**Docker**](https://www.docker.com)
- [**Docker Compose**](https://docs.docker.com/compose)
- [**Make**](https://www.gnu.org/software/make/)
- [**Node.js**](https://nodejs.org)
- [**Yarn**](https://yarnpkg.com)

## 🥞 Stack
- [**Babel**](https://babeljs.io)
- [**Browsersync**](https://www.browsersync.io)
- [**Bulma**](https://bulma.io)
- [**Gulp**](https://gulpjs.com)
- [**Sass**](https://sass-lang.com)
- [**Timber**](https://www.upstatement.com/timber)
- [**Webpack**](https://webpack.js.org)
- [**WordPress**](https://wordpress.org)

## ⚙️ Getting started
**Step 1:** Rename the [`md-starter-theme` folder](app/wp-content/themes/md-starter-theme) using your **`theme-name`**.

**Step 2:** Rename every occurrence of `md-starter-theme` in the parent folder (except in `README.md`) using your **`theme-name`**.

**Step 3:** Edit all informations related to your theme in [`style.css`](app/wp-content/themes/md-starter-theme/style.css):

```css
/**
 * Theme Name: MD starter theme
 * Author: MD
 * Author URI: https://wearemd.com
 * Version: 1.0.0
 * Text Domain: md-starter-theme
 */
```

**Step 4 *(optional)***: WordPress will be downloaded in french by default. If you want your website to be in another language, set [`--locale` in `Makefile`](Makefile#L15) (see the [Complete List of WordPress Locale Codes](https://wpastra.com/docs/complete-list-wordpress-locale-codes/)).

**Step 5:** Run the following command to get everything ready:

```
make setup
```

**Your WordPress is ready to be themed!**

## ⌨️ Commands
### Setup
```makefile
# Get everything ready (Docker containers, WordPress download and configuration)

make setup
```

### Serve
```makefile
# Serve:
# - WordPress front-office at localhost:3000 with live reloading
# - WordPress back-office at localhost:3010/wp-admin
#   (username: admin, password: password)
# - phpMyAdmin at localhost:3011

make
```

💡 This command will also **install dependencies** on first run and when `package.json` or `yarn.lock` files are updated.

### Build
```makefile
# Build WordPress theme for production use

make build
```

💡 This command will also **install dependencies** on first run and when `package.json` or `yarn.lock` files are updated.

### Help
```makefile
# List available commands

make help
```

## 🗄️ Project structure
See [WIP project structure](project-structure)

## 🚨 Lint PHP files using WordPress Coding Standards
Follow these steps if you want to lint PHP files using [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards).

**Step 1:** Install `wp-coding-standards/wpcs`:

```
make install_wpcs
```

**Step 2:** Move to your theme folder.

**Step 3:** Set path for `wpcs`:

```
composer config-set
```

**Step 4:** You are now able to lint any PHP file:

```
composer lint [filename].php
```

## 🍱 Cache busting
Our strategy for cache busting is to automatically append a `?ver=[version]` to each asset query. When you need to bust the cache, simply update [`Version` in theme `style.css`](app/wp-content/themes/md-starter-theme/style.css#L5).

## 🤜🤛 Contributing
Contributions, issues and feature requests are welcome!

## 📄 License
WordPress starter is licensed under the [GNU General Public License v3.0](LICENSE).
