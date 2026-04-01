#!/usr/bin/env bash
# [MISE] description = ""
# [MISE] depends = ["docker:healthcheck", "composer:install"]
# [MISE] wait_for = ["docker:compose:down"]
# [MISE] env = { VERBOSE = 1, COLOR = 1 }

hurl ${HURL_REQUESTS_FILES} --variables-file ${HURL_VARS_FILE:-hurl.env} ${VERBOSE:+--verbose} ${COLOR+--color}
