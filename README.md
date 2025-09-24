# Yii2 Fixer

Yii2 Fixer is a code style fixer for Yii2 projects. It uses PHP-CS-Fixer under the hood to enforce consistent coding standards.

## Installation

Install as a development dependency via Composer:

```bash
composer require --dev zhikariz/yii2-fixer
```

**Note**: This package requires PHP 8.1+. If your project uses an older PHP version, you can still install it by setting the `PHP_CS_FIXER_IGNORE_ENV` environment variable:

```bash
PHP_CS_FIXER_IGNORE_ENV=1 composer require --dev zhikariz/yii2-fixer
```

However, the tool will only work on PHP 8.1+ systems.

Or clone the repository and run:

```bash
composer install
```

## Usage

### Basic Usage

Fix code style in the current directory:

```bash
./vendor/bin/yii2-fixer fix
```

Fix a specific file or directory:

```bash
./vendor/bin/yii2-fixer fix app/models/
./vendor/bin/yii2-fixer fix app/models/User.php
```

### Configuration

By default, Yii2 Fixer uses the included `fixer.php` configuration file. You can specify a custom config file (PHP, JSON or YAML) to override rules:

```bash
./vendor/bin/yii2-fixer fix --config custom-config.json
```

#### Custom Configuration

Create a `custom-config.json` file in your project root:

```json
{
  "rules": {
    "@PSR12": true,
    "array_syntax": {
      "syntax": "short"
    },
    "indentation_type": true
  },
  "notPath": ["vendor/*", "node_modules/*", "storage/*", "tests/_output/*"]
}
```

Or use YAML format (`custom-config.yaml`):

```yaml
rules:
  "@PSR12": true
  array_syntax:
    syntax: short
  indentation_type: true
notPath:
  - "vendor/*"
  - "node_modules/*"
  - "storage/*"
  - "tests/_output/*"
```

Then run:

```bash
./vendor/bin/yii2-fixer fix --config custom-config.json
# or
./vendor/bin/yii2-fixer fix --config custom-config.yaml
```

The configuration file should return a `PhpCsFixer\Config` instance.

### Rules

Yii2 Fixer enforces the following rules:

- PSR-2 coding standard
- Short array syntax
- 4 spaces indentation
- Single quotes for strings
- Proper class attribute separation
- PHPDoc formatting
- And more...

See `fixer.php` for the complete list of rules.

## Development

To run tests:

```bash
./vendor/bin/phpunit
```

## License

MIT License
