# MD Starter Theme

## WordPress Coding standards

To install the __WordPress Coding standards__ just type

```bash

make create-project

```

Then set path to `wpcs` command

```bash

make config-set

```

Add the script command to `composer.json`

```json

{
    "scripts": {
        "lint": "vendor/bin/phpcs --standard=WordPress"
    }
}

```

And then, to lint `functions.php` for example, type:

```bash

composer lint functions.php

```
