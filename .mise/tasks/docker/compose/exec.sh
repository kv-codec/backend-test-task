#!/usr/bin/env bash
# [MISE] description = "Run a command in a given container"
# [MISE] depends = [ "docker:healthcheck" ]
source "${MISE_PROJECT_ROOT}/.mise/lib/io.sh"

docker_exec() {
    local SERVICE="${EXEC_TARGET_SERVICE:-php}"
    local ENVS=()
    local ARGS=()

    while [[ $# -gt 0 ]]; do
        case "$1" in
            --)
                shift
                ARGS+=("$@")
                break
                ;;
            -e|--env)
                ENVS+=("$1" "$2")
                shift 2
                ;;
            --service)
                SERVICE="$2"
                shift 2
                ;;
            *)
                ARGS+=("$1")
                shift
                ;;
        esac
    done

    local TTY
    if [ -t 0 ]; then TTY=1; fi
    log "TTY value: ${TTY}"
    docker compose exec -i ${TTY:+"-t"} "${ENVS[@]}" "${SERVICE}" "${ARGS[@]}"
}

if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    docker_exec "$@"
fi
