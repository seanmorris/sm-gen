# OSX Specific Stuff

## Installing php-yml on OSX:

Installing PHP can be tricky on non-linux systems. The default install provided by brew has no simple pathway to installing php-yml, so we can use [shivammathur's distibution](https://setup-php.com/) from <https://setup-php.com>.

Add the repositories to brew:

```bash
brew tap shivammathur/php
brew tap shivammathur/extensions
```

Install & override PHP with the newly installed version:

```bash
brew install shivammathur/php/php@8.4
brew link --overwrite --force shivammathur/php/php@8.4
```

Ensure PHP is installed correctly and the correct version is being invoked:

```bash
php -v
```

```bash
brew install shivammathur/extensions/yaml@8.4
```

Ensure the yaml extension is installed and usable from PHP:

```bash
php -m | grep yaml
```

## `smgen watch` is unavailable

Unfortunately inotify-tools is not available under OSX, so the file watcher is currently unavailable.

You can however manually call `smgen serve` and `smgen build` manually.
