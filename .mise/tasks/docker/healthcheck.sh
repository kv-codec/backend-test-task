#!/usr/bin/env bash
#MISE description="Wait until all containers are healthy"
#MISE depends=["docker:compose:up"]
source "${MISE_PROJECT_ROOT}/.mise/lib/io.sh"

SERVICES=()
IFS=';' read -ra SERVICES <<< "${DC_SERVICES}"

VERBOSE=1 log "Waiting for services to be healthy..."

for service in "${SERVICES[@]}"; do
    until [[ "$(docker inspect --format='{{.State.Health.Status}}' $(docker compose ps ${service} -q))" == "healthy" ]]; do
        sleep 1
    done
    log "Service [$service] is healthy"
done

VERBOSE=1 log "All services are healthy"
