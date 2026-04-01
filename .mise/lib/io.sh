#!/usr/bin/env bash

source "${MISE_PROJECT_ROOT}/.mise/lib/is_true.sh"

VERBOSE="${VERBOSE:-false}"

# verbose cmd args...
# Runs command silently if VERBOSE=1|true, otherwise normally
verbose() {
    if is_true "$VERBOSE"; then
        "$@"
    else
        "$@" > /dev/null 2>&1
    fi
}

# log "message" -- prints if not silent
log() {
    if is_true "$VERBOSE"; then echo "$@"; fi
    return 0
}
