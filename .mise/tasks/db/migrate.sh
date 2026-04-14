#!/usr/bin/env bash
# [MISE] description = ""
# [MISE] depends = ["composer:install"]

mise docker:compose:exec --service php -- bin/console doctrine:migrations:migrate --no-interaction
