# Read that before start

## Pre-requirements

Please check if you have installed it locally:

* node version 16
* npm version 8
* php version 7.4
* composer

## First run

At the very beginning, you should prepare your theme for further development. Install all dependencies and build main libraries for the website

1. Remove wp-content directory
2. Clone this repository to the WordPress root folder and name cloned folder `wp-content`
3. Install Advanced Custom Fields Pro
4. Copy `.env.sample` to `.env` (<b>do not change the file name</b>, just create a new `.env` file with the same content
   which is in the `.env.sample` file)
5. Configure variables in `.env` file according to your local WordPress settings
6. Run `npm install`
7. Run `composer install`

## Development: BrowserSync + Livereload + watchers

To start development, just type in the command line `npm start`
It will run SCSS and JS code compilators and linters.

## Checking code quality

To lint your code, type in the console (in this root repository directory):
`lint:php` - check PHP code quality
`lint:scss` - check SCSS code quality
`lint:js` - check JS code quality

To autofix your code:
`lint:php-fix` - auto fix PHP code errors
`lint:scss-fix` - auto fix SCSS code errors
`lint:js-fix` - auto fix JS code errors

## Building bundle

Deploying all source files is not the best practice. For that reason, you can build a zip package with your theme

1. Run `npm install`
2. Run `npm run bundle`

It will take only the required files and compress them into a zip file that can be easily installed on the website via
the admin panel.

## Building styles and scripts

Compiled assets are not included in the repository, so the website won't be displayed properly at the beginning

1. Run `npm install`
2. Run `npm run build`

# Configure PhpStorm
First of all, check do you have the latest version of PhpStorm.

Go to PhpStorm Preferences (Settings in windows)

PHP -> PHP language level -> select PHP 7.4
PHP -> CLI Interpreter -> select interpreter that you use

PHP -> Composer -> Indicate path to composer.json in the `wp-content` directory
PHP -> Composer -> select "Synchronize IDE settings with composer.json"
PHP -> Composer -> select composer executable path (`/usr/local/bin/composer` on mac)


PHP -> quality tools -> PHP_CodeSniffer
Click 3 donts next to configuration, Browse patth, select localization in theme_folder/vendor/bin/phpcs and validate it
Expand PHP Code Beautifier and Fixer Settings and select path to the `/vendor/bin/phpcsbf`
Click PHP_CodeSniffer inspection -> PHP_CodeSniffer validation -> Coding standard: Custom indicate `.phpcs.xml` file (it may be invisible on the list as a hidden file, so you need to type the name) in the repository directory + uncheck `installed standard path` + change files extensions to `php` only

PHP -> Frameworks -> WordPress -> Enable WordPress integration + indicate the WordPress root folder of the current project

Plugins -> if you know you will not use something, you can uncheck it. It may simplify management, linting, code completing, and speed of PHP storm (Drupal, Laravel, Tailwind, Docker, etc.)

Languages & Frameworks -> enable stylelint, package select `/node_modules/stylelint` + configuration file `.stylelintrc` - you may have to type the name, because file may be invisible
Run for files: {**/*,*}.{css,scss}

Editor -> Code style -> PHP - import scheme from the theme folder phpstorm-php.xml

Preferences | Languages & Frameworks | JavaScript | Code Quality Tools | ESLint -> Select automatic ESLint configuration + Run eslint --fix on save

Editor -> Live template -> disable things that you don't need.

# Theme

## The main idea behind the theme

According to the WordPress roadmap, the theme should be built in HTML, and all blocks should be defined in the plugin
folder.

Because of many reasons(new approach limitations, difficulty in coding, entry threshold, etc.), we have a hybrid
approach and still use PHP templates in DeveloPress. Anyway, we aim to adjust this approach to the official and
recommended way.

For that reason, we shouldn't have any logic in the theme folder. Just pure PHP templates that will be converted into
HTML files in the future.
We also should aim for the recommended structure of the theme folder.

According to the documentation, the theme folder should contain:
Fonts and some of the required assets like images and videos
Common section definition in HTML - footer, header, etc.
Common page definition in HTML - archive, index, page, single, etc.
Common styles saved in JSON
Patterns definition - something that we call blocks or modules in DeveloPress

But, as I mentioned above, we still use PHP files and a hybrid approach for now.

## Instruction for the theme development - good practice

1. Configure mixins
1. Configure fonts - https://google-webfonts-helper.herokuapp.com/fonts
1. Configure typography
1. Configure buttons
1. Configure forms

## Register block patterns

Before we migrate to the proper blocks and block patterns, we use ACF blocks as a blocks patterns.

To register custom ACF block go to the `/wp-content/themes/theme/inc/Block_Patterns.php` and define all blocks in
the `$blocks_to_register` array.

# Buddy - DevOps
Please remember to enable support for Pull Request on the https://buddy.works when you add new project.

Please also notice, that pipeline for PR is not visible in buddy until you don't have any PR in the repository


# TODO nice to have:
* Improve typography scss file for further development
* Prepare the most common elements for better typography and buttons development
* livereload ONLY for our files in our theme and in our plugin - it may be performance issue on slow computers, because we track almost the whole `wp-content` directory
* Prepare documentation for the theme development - how to configure mixins
* Caching issue - automatization for the assets version
* why we had this bug with revisions on the CAI website? In the post revision we had a block that didn't exist anymore, and it collapsed the website
* move `CPT` and `blocks` to the `domain` folder
* Convert Options Page to a native WordPress page, not as a ACF options page
* watcher for linter and configuration build in an IDE
* Add PEST
* Add phpstan https://github.com/phpstan/phpstan
* Connect to sentry
* Add visual regression tests
* Add images optimalization
* https://fullsiteediting.com/lessons/theme-json-color-options/
* Disable unnecessary blocks in theme https://wplift.com/restrict-disable-gutenberg-blocks
* Disable unnecessary settings in theme.json https://themegen-preview.vercel.app/?mc_cid=f9f237db21&mc_eid=d0602161b3
* Hoist blocks list and CPT list to a main plugin file. Putting 1 file of block in separate folder is overcomplicated
* Get rid of ACF and build websites with Gutenberg only
* should I extends some models for WP_POSTS?
* implement data provider?
* implement data saver (it may be responsible for data sanitization, validation and handling data saving)?
* implement DB migrations like phinx
