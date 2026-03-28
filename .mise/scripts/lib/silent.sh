#!/usr/bin/env bash
silent() {
    [ "${DC_RUN_SILENT:-0}" = "1" ] || [ "${DC_RUN_SILENT:-0}" = "true" ]
}
