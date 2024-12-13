#!/usr/bin/env bash
set -e

vendor/bin/phpcs --standard=phpcs.xml.dist --warning-severity=0 -p src/ test/
vendor/bin/php-cs-fixer fix --dry-run --config=.php-cs-fixer.dist.php
vendor/bin/phpunit --log-junit="build/${dependencies}-phpunit.xml"
