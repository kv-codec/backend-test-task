#!/usr/bin/env bash

ENVS=()
ARGS=()

while [[ $# -gt 0 ]]; do
    case "$1" in
        -e|--env)
            ENVS+=("$1" "$2")
            shift 2
            ;;
        *)
            ARGS+=("$1")
            shift
            ;;
    esac
done

TTY_FLAG=""
STDIN_FD=0 # STDIN file descriptor integer value
[ -t $STDIN_FD ] && TTY_FLAG="-t"

docker exec -i ${TTY_FLAG} "${ENVS[@]}" "$DOCKER_PHP_CONTAINER_NAME" "${ARGS[@]}"
