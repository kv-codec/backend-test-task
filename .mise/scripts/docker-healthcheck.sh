#!/usr/bin/env bash
source "$(dirname $0)/lib/silent.sh"

CONTAINERS=(
    "${DOCKER_PHP_CONTAINER_NAME:-sio_test}"
    # "${DOCKER_DB_CONTAINER_NAME:-sio_db}"
)

silent || echo "Waiting for containers to be healthy..."

for container in "${CONTAINERS[@]}"; do
    until [ "$(docker inspect --format='{{.State.Health.Status}}' "$container")" = "healthy" ]; do
        sleep 1
    done
    silent || echo "$container is healthy"
done

silent || echo "All containers are healthy"
