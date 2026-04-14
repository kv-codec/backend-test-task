#!/usr/bin/env bash
# [MISE] description = ""
# [MISE] depends = ["docker:healthcheck", "composer:install", "db:fixtures"]
# [MISE] wait_for = ["docker:compose:down", "tests:mutation"]
# [MISE] env = { VERBOSE = 1, COLOR = 1 }

hurl ${HURL_REQUESTS_FILE} --variables-file ${HURL_VARS_FILE:-hurl.env} ${VERBOSE:+--verbose} ${COLOR+--color}
