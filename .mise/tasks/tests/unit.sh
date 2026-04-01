#!/usr/bin/env bash
# [MISE] description = "Runs unit tests with Pest"
# [MISE] depends = ["docker:healthcheck", "composer:install"]
# [MISE] wait_for = ["docker:compose:down"]
# [MISE] env = { RUN_PARALLEL = 1 }

mise docker:compose:exec --service php -- \
    "${PHP_TEST_RUNNER:-vendor/bin/pest}" \
    "${RUN_PARALLEL:+--parallel}" \
    "$@"
