#!/usr/bin/env bash
# [MISE] description = "Runs unit tests with Pest"
# [MISE] depends = ["docker:healthcheck", "composer:install"]
# [MISE] wait_for = ["docker:compose:down"]

mise docker:compose:exec --service php -- \
    "${PHP_TEST_RUNNER:-vendor/bin/pest}" \
    --display-all-issues \
    "${RUN_PARALLEL:+--parallel}" \
    "$@"
