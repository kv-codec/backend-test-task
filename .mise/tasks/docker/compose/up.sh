#!/usr/bin/env bash
# [MISE] description="Start containers in detached mode"
# [MISE] wait_for=["docker:compose:down"]

source "${MISE_PROJECT_ROOT}/.mise/lib/io.sh"

SERVICES=()
IFS=';' read -ra SERVICES <<< "${DC_SERVICES}"
log "Docker Compose services: [${SERVICES[@]}]"
are_all_running() {
    local expected=${#SERVICES[@]}
    local actual
    actual=$(docker compose ps "${SERVICES[@]}" \
        --format '{{.Service}}' \
        --status running \
        2>/dev/null | wc -l)
    if [[ "$expected" == "$actual" ]]; then
        log "All expected services (${SERVICES[@]}) are in status 'running'"
        return 0;
    else
        return 1;
    fi
}

# early exit
if are_all_running && [[ -z "${FORCE_RERUN}" || "${FORCE_RERUN,,}" == "false" || "${FORCE_RERUN}" == "0" ]]; then
    verbose echo "Nothing to do";
    exit 0;
fi

verbose docker compose ${COMPOSE_FILE:+"-f"} "${COMPOSE_FILE}" up \
    --build \
    --remove-orphans \
    --force-recreate "${SERVICES[@]}" \
    -d
