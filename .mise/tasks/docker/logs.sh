#!/usr/bin/env bash
#MISE description="Follow container logs"

docker compose -f "${COMPOSE_FILE:-'docker-compose.yaml'}" logs --follow
