<h1 align="center">WordPress starter</h1>
<p align="center"><strong>WordPress starter</strong> is a starter template for WordPress websites<br>featuring Docker, Gulp and Webpack.</p>

## ⚙️ Prerequisites
- [**asdf**](https://github.com/asdf-vm/asdf)
- [**Composer**](https://getcomposer.org)
- [**Docker**](https://www.docker.com)
- [**Docker Compose**](https://docs.docker.com/compose)
- [**Make**](https://www.gnu.org/software/make)
- [**Node.js**](https://nodejs.org)
- [**Yarn**](https://yarnpkg.com)

## 🥞 Stack
- [**Babel**](https://babeljs.io)
- [**Bulma**](https://bulma.io)
- [**Gulp**](https://gulpjs.com)
- [**Sass**](https://sass-lang.com)
- [**Timber**](https://www.upstatement.com/timber)
- [**Webpack**](https://webpack.js.org)
- [**WordPress**](https://wordpress.org)

## ⚙️ Getting started
**Step 1:** First rename the [`md-starter-theme`](https://github.com/wearemd/wordpress-starter/tree/master/app/wp-content/themes/md-starter-theme) folder using your **`theme-name`**.

**Step 2:** Then rename every occurrence of `md-starter-theme` in the parent folder (except in `README.md`) using your **`theme-name`**.

**Step 3:** You can now edit all informations related to your theme in [`style.css`](https://github.com/wearemd/wordpress-starter/blob/master/app/wp-content/themes/md-starter-theme/style.css):

```css
/**
 * Theme Name: MD starter theme
 * Author: MD
 * Author URI: https://wearemd.com
 * Version: 1.0.0
 * Text Domain: md-starter-theme
 */
```

**Step 4 *(optional)***: WordPress will be downloaded in french by default. If you want your website to be in another language, set `--locale` in [`Makefile`](https://github.com/wearemd/wordpress-starter/blob/master/Makefile#L17). See the [Complete List of WordPress Locale Codes](https://wpastra.com/docs/complete-list-wordpress-locale-codes/).

**Step 5:** Finally run `make setup` to get everything ready:
- Docker containers
- WordPress download
- WordPress configuration
- Etc.

**Your WordPress is ready to be themed**, well done fella 👊

## ⌨️ Commands
### Serve
* Run WordPress on [localhost:3000](http://localhost:3000) with livereload
* Run phpMyAdmin on [localhost:3011](http://localhost:3011)
* Make WordPress back-office accessible at [localhost:3010/wp-admin](http://localhost:3010/wp-admin)
  * Username: `admin`
  * Password: `password`

```
make
```

💡 This command will also install dependencies on first run and when `package.json` or `yarn.lock` files are updated.

### Build
Build everything with Webpack and Gulp production environment to WordPress theme directory.

```
make build
```

### Help
Display a list of available commands.

```
make help
```

## 🗄️ Project structure
```
.
├── app
│   ├── wp-cli.yml                           # WP-CLI configuration file
│   └── wp-content/themes/md-starter-theme   # WordPress theme
│       ├── 404.php                          # 404 page declaration
│       ├── app.css                          # Minified, optimized and compiled style
│       ├── fonts                            # Fonts folder
│       ├── functions.php                    # Specific theme customization
│       │                                    # See codex.wordpress.org/Functions_File_Explained
│       ├── images                           # Images folder
│       ├── index.php                        # Index page declaration
│       ├── js                               # Minified, optimized and compiled JavaScript
│       ├── languages                        # Languages folder
│       ├── lib                              # Specific theme customization
│       │   ├── class-md-starter-theme.php   # Theme declaration and initialization
│       │   ├── reset.php                    # Deactivate emoji 
│       │   └── sanitize-wysiwyg.php         # Customize WISIWYG
│       ├── page.php                         # Simple page declaration 
│       ├── post-types                       # Post types folder 
│       ├── screenshot.png                   # Screenshot of the theme
│       ├── style.css                        # CSS declaration of the theme
│       └── templates                        # Twig templates folder
│           ├── 404.twig                     # 404 template
│           ├── components                   # Components templates folder
│           │   ├── navbar-footer.twig       # Navbar footer template
│           │   └── navbar.twig              # Navbar template
│           ├── dev                          # Development templates folder
│           │   └── lorem.twig               # Lorem Ipsum template
│           ├── index.twig                   # Index template
│           ├── layouts                      # Layouts templates folder
│           │   └── default.twig             # Base layout template
│           ├── page.twig                    # Simple page template
│           └── single.twig                  # Single Post template
│
├── gulp                                     # Gulp tasks and configuration
│   ├── env                                  # Gulp configuration file per environment
│   │   ├── dev.js                           # Development environment configuration file
│   │   └── prod.js                          # Production environment configuration file
│   ├── index.js                             # Script to invoke correct environment and 
│   │                                        # dinamically load tasks from tasks folder
│   ├── tasks                                # Gulp tasks folder
│   │   ├── sass.js                          # Sass task declaration
│   │   └── script.js                        # JavaScript task declaration
│   └── webpack                              # Webpack configuration files
│       ├── common.js                        # Configuration shared between dev and prod environment
│       ├── dev.js                           # Development environment configuration file
│       └── prod.js                          # Production environment configuration file
│
├── js                                       # JavaScript source files
│   └── app.js                               # Main JavaScript file used as entry by Webpack
│
├── sass                                     # Theme Sass stylesheets 
│   ├── dev                                  # Development style folder
│   │   ├── _all.sass                        # Sass file to register all development styles
│   │   └── shame.sass                       # Here we put WIP style or dirty hacks
│   │                                        # See csswizardry.com/2013/04/shame-css/
│   ├── libs                                 # Libraries style folder
│   │   └── _all.sass                        # Sass file to register all libraries styles
│   └── style.sass                           # Main Sass file used by as source by Gulp
│
├── .babelrc                                 # Tells Babel which presets and plugins to use 
├── .tool-versions                           # Tells asdf which version to use locally 
│                                            # for each language
├── docker-compose.yml                       # Docker Compose file to define services,
│                                            # networks and volumes
├── Dockerfile                               # Docker container declaration
├── gulpfile.js                              # Gulp configuration
├── Makefile                                 # Defines commands for this project
└── package.json                             # Defines libraries and dependencies 
                                             # for JS packages, used by Yarn
```

## 🚨 [WordPress Coding standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) 

**Step 1:** Run `make create_project` to install `wp-coding-standards/wpcs`.

**Step 2:** Move to your theme folder and run `composer config-set` to set path for `wpcs`.

You are now able to lint PHP files using WordPress Coding standards, for example with `functions.php`:

```
composer lint functions.php
```

## 🔖 Versioning
When you update the WordPress theme, don’t forget to **change the theme version number in [`style.css`](https://github.com/wearemd/wordpress-starter/blob/master/app/wp-content/themes/md-starter-theme/style.css#L5) before deploying**. This version number will append to CSS/JS files to bust browser cache on those assets.

## 🤜🤛 Contributing
Contributions, issues and feature requests are welcome!

## 📝 License
WordPress starter is licensed under the [GNU General Public License v3.0](LICENSE).
