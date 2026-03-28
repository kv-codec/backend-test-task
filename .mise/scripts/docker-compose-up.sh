#!/usr/bin/env bash
source "$(dirname $0)/lib/silent.sh"
if silent; then
    docker compose up -d --build ${DC_SERVICES:-} > /dev/null 2>&1
else
    docker compose up -d --build ${DC_SERVICES:-}
fi
