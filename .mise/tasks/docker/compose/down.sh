#!/usr/bin/env bash
#MISE description="Stop and remove containers"

source "${MISE_PROJECT_ROOT}/.mise/lib/io.sh"

verbose docker compose -f "${COMPOSE_FILE:-'docker-compose.yaml'}" down \
    --remove-orphans \
    --rmi local \
    --timeout "${DC_TIMEOUT:-10}"
