#!/usr/bin/env bash
# [MISE] description = ""
# [MISE] depends = ["docker:healthcheck", "db:migrate"]

mise docker:compose:exec --service php -- bin/console doctrine:fixtures:load --no-interaction
