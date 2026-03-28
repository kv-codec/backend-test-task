#!/usr/bin/env bash
if [ "${DC_RUN_SILENT:-0}" = "1" ] || [ "${DC_RUN_SILENT:-0}" = "true" ]; then
    docker compose up -d --build ${DC_SERVICES:-} > /dev/null 2>&1
else
    docker compose up -d --build ${DC_SERVICES:-}
fi

if [ "${DC_RUN_SILENT:-0}" != "1" ] || [ "${DC_RUN_SILENT:-0}" != "true" ]; then echo "Waiting for containers to be healthy..."; fi
until [ "$(docker inspect --format='{{.State.Health.Status}}' "${DOCKER_PHP_CONTAINER_NAME:-sio_test}")" = "healthy" ]; do
    sleep 1
done
if [ "${DC_RUN_SILENT:-0}" != "1" ] || [ "${DC_RUN_SILENT:-0}" != "true" ]; then echo "Containers are healthy"; fi
