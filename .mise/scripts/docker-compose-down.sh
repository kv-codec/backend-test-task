#!/usr/bin/env bash
source "$(dirname $0)/lib/silent.sh"
if silent; then
    docker compose down --remove-orphans --rmi local --timeout ${DC_TIMEOUT:-10} > /dev/null 2>&1
else
    docker compose down --remove-orphans --rmi local --timeout ${DC_TIMEOUT:-10}
fi
