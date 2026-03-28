#!/usr/bin/env bash
if [ "${DC_RUN_SILENT:-0}" = "1" ] || [ "${DC_RUN_SILENT:-0}" = "true" ]; then
    docker compose down --remove-orphans --rmi local --timeout ${DC_TIMEOUT:-10} > /dev/null 2>&1
else
    docker compose down --remove-orphans --rmi local --timeout ${DC_TIMEOUT:-10}
fi
