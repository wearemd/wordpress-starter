<p align="center">
  <img width="600px" src="README-header.gif" alt="">
</p>
<p align="center">
  <strong>WordPress starter</strong> is a starter template for WordPress websites.
  <br>
  <b>Stack:</b>
  <b><a href="https://babeljs.io">Babel</a></b>,
  <b><a href="https://www.browsersync.io">Browsersync</a></b>,
  <b><a href="https://bulma.io">Bulma</a></b>,
  <b><a href="https://gulpjs.com">Gulp</a></b>,
  <b><a href="https://sass-lang.com">Sass</a></b>,
  <b><a href="https://www.upstatement.com/timber">Timber</a></b>,
  <b><a href="https://webpack.js.org">Webpack</a></b>,
  <b><a href="https://wordpress.org">WordPress</a></b>.
</p>

- - -

## 📝 Table of contents
- [**Prerequisites**](#prerequisites)
- [**Getting started**](#getting-started)
- [**Commands**](#commands)
- [**Project structure**](#project-structure)
- [**Linting PHP files**](#linting-php-files)
- [**Cache busting**](#cache-busting)
- [**Authors**](#authors)
- [**Contributing**](#contributing)
- [**License**](#license)

- - -

<a name="prerequisites"></a>
## ⚙️ Prerequisites
- [**asdf**](https://github.com/asdf-vm/asdf)
- [**Composer**](https://getcomposer.org)
- [**Docker**](https://www.docker.com)
- [**Docker Compose**](https://docs.docker.com/compose)
- [**Make**](https://www.gnu.org/software/make/)
- [**Node.js**](https://nodejs.org)
- [**Yarn**](https://yarnpkg.com)

<a name="getting-started"></a>
## 🏁 Getting started
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

<a name="commands"></a>
## ⌨️ Commands
### Setup
```makefile
## Get everything ready (Docker containers, WordPress download
## and configuration)

make setup
```

### Serve
```makefile
## Serve:
## - WordPress front-office at http://localhost:3000 with live reloading
## - WordPress back-office at http://localhost:3010/wp-admin
##   (username: admin, password: password)
## - phpMyAdmin at http://localhost:3011

make
```

💡 This command will also **install dependencies** on first run and when `package.json` or `yarn.lock` files are updated.

### Build
```makefile
## Build WordPress theme for production use

make build
```

💡 This command will also **install dependencies** on first run and when `package.json` or `yarn.lock` files are updated.

### Help
```makefile
## List available commands

make help
```

<a name="project-structure"></a>
## 🗄️ Project structure
```
.
├── app                                    # WORDPRESS SITE
│   ├── wp-content/themes/md-starter-theme # WordPress theme to customize
│   │   ├── fonts                          # Font assets
│   │   │   └── .gitkeep                   # Tracking an empty directory within Git
│   │   │
│   │   ├── images                         # Image assets
│   │   │   └── .gitkeep                   # Tracking an empty directory within Git
│   │   │
│   │   ├── languages                      # Localization
│   │   │   ├── mdstartertheme.mo          # Compiled theme localization
│   │   │   └── mdstartertheme.po          # Theme localization
│   │   │
│   │   ├── lib                            # Theme features
│   │   │   ├── class-md-starter-theme.php # Theme declaration and initialization
│   │   │   ├── reset.php                  # Deactivating WordPress emoji-support
│   │   │   └── sanitize-wysiwyg.php       # WordPress back-office WYSIWYG sanitization
│   │   │
│   │   ├── post-types                     # Post types
│   │   │   └── .gitkeep                   # Tracking an empty directory within Git
│   │   │
│   │   ├── templates                      # Twig templates
│   │   │   ├── components                 # Components
│   │   │   │   ├── navbar-footer.twig     # Footer navbar
│   │   │   │   └── navbar.twig            # Main navbar
│   │   │   │
│   │   │   ├── dev                        # Partials for development
│   │   │   │   └── lorem.twig             # Partial featuring text in lorem
│   │   │   │
│   │   │   ├── layouts                    # Layouts
│   │   │   │   └── default.twig           # Default layout
│   │   │   │
│   │   │   ├── 404.twig                   # 404 error page
│   │   │   ├── index.twig                 # Home page
│   │   │   ├── page.twig                  # Page
│   │   │   └── single.twig                # Single post
│   │   │
│   │   ├── 404.php                        # 404 error page declaration
│   │   ├── composer.json                  # PHP dependencies, used by Composer
│   │   ├── composer.lock                  # Tracking exact versions for PHP dependencies,
│   │   │                                  # used by Composer
│   │   ├── functions.php                  # Changing WordPress default behavior
│   │   ├── index.php                      # Home page declaration
│   │   ├── page.php                       # Page declaration
│   │   ├── screenshot.png                 # Theme screenshot, used in WordPress back-office
│   │   └── style.css                      # Theme CSS declaration
│   │
│   └── wp-cli.yml                         # WP-CLI configuration
│
│
├── gulp                                   # GULP/WEBPACK CONFIGURATION AND TASKS
│   ├── env                                # Gulp configuration per environment
│   │   ├── dev.js                         # Development environment
│   │   └── prod.js                        # Production environment
│   │
│   ├── tasks                              # Gulp tasks
│   │   ├── sass.js                        # Sass task declaration
│   │   └── script.js                      # JavaScript task declaration
│   │
│   ├── webpack                            # Webpack configuration per environment
│   │   ├── common.js                      # Shared between development and production environments
│   │   ├── dev.js                         # Development environment
│   │   └── prod.js                        # Production environment
│   │
│   └── index.js                           # Script to invoke proper environment and dynamically load
│                                          # Gulp tasks
│
│
├── js                                     # JAVASCRIPT SOURCE FILES
│   └── app.js                             # Main JavaScript file used as entry by Webpack
│
│
├── sass                                   # SASS STYLE
│   ├── dev                                # WIP style for development
│   │   └── shame.sass                     # WIP style or dirty hacks
│   │
│   ├── libs                               # Libraries
│   │   └── _all.sass                      # File used to import all libraries (e.g. Bulma)
│   │
│   └── style.sass                         # Main Sass file used as source by Gulp
│
│
├── .babelrc                               # Presets and plugins to use, used by Babel
├── .gitignore                             # Files and folders ignored by Git
├── .tool-versions                         # Which version to use locally for each language, used by asdf
├── docker-compose.yml                     # Services, networks and volumes, used by Docker Compose
├── Dockerfile                             # Docker containers declaration
├── dwp                                    # Script to use WP-CLI inside a Docker container
├── gulpfile.js                            # Gulp configuration
├── LICENSE                                # License
├── Makefile                               # Commands for this project
├── package.json                           # JavaScript dependencies, used by Yarn
├── README-header.gif                      # README header image
├── README.md                              # Project documentation
└── yarn.lock                              # Tracking exact versions for JavaScript dependencies,
                                           # used by Yarn
```

<a name="linting-php-files"></a>
## 🚨 Linting PHP files
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

<a name="cache-busting"></a>
## 🍱 Cache busting
Our strategy for cache busting is to automatically append a `?ver=[version]` to each asset query. When you need to bust the cache, simply update [`Version` in `style.css`](app/wp-content/themes/md-starter-theme/style.css#L5).

<a name="authors"></a>
## ✍️ Authors
- [**@Awea**](https://github.com/Awea) - Idea and initial work
- [**@mmaayylliiss**](https://github.com/mmaayylliiss) - Design, code/documentation review

<a name="contributing"></a>
## 🤜🤛 Contributing
**Contributions, issues and feature requests are welcome!** See the list of [contributors](../../graphs/contributors) who participated in this project.

<a name="license"></a>
## 📄 License
WordPress starter is licensed under the [GNU General Public License v3.0](LICENSE).
