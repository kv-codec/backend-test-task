#!/usr/bin/bash -vx

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

docker exec -it "${ENVS[@]}" "$DOCKER_PHP_CONTAINER_NAME" "${ARGS[@]}"
