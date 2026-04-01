#!/usr/bin/env bash
# [MISE] description = ""
# [MISE] depends = [ "docker:healthcheck" ]

mise docker:compose:exec --service php -- composer install
