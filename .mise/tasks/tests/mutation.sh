#!/usr/bin/env bash
# [MISE] description = "Runs mutation tests with Pest"
# [MISE] depends = ["docker:healthcheck", "composer:install"]
# [MISE] wait_for = ["docker:compose:down", "tests:unit"]

mise docker:compose:exec --service php -- \
    "${PHP_TEST_RUNNER}" \
    --mutate \
    # "${RUN_PARALLEL:+--parallel}" \ #FIXME(kv-codec): doesn't work cause workers return 1 exit code
    "$@"
