#!/usr/bin/env bash

set -euo pipefail

repo_root="$(git rev-parse --show-toplevel)"
cd "$repo_root"

mapfile -t metadata_files < <(find blocks -mindepth 2 -maxdepth 2 -name block.json -print | sort)

if [[ ${#metadata_files[@]} -ne 29 ]]; then
    echo "Expected 29 block.json files; found ${#metadata_files[@]}." >&2
    exit 1
fi

for metadata_file in "${metadata_files[@]}"; do
    folder="${metadata_file#blocks/}"
    folder="${folder%/block.json}"
    expected_name="kndsb/${folder}"
    actual_name="$(jq -er '.name' "$metadata_file")"

    if [[ "$actual_name" != "$expected_name" ]]; then
        echo "$metadata_file: expected name $expected_name, found $actual_name." >&2
        exit 1
    fi

    jq -e . "$metadata_file" >/dev/null

    while IFS= read -r reference; do
        relative_path="${reference#file:./}"
        target="$(dirname "$metadata_file")/$relative_path"
        if [[ ! -f "$target" ]]; then
            echo "$metadata_file: referenced file does not exist: $target" >&2
            exit 1
        fi
    done < <(
        jq -r '[.editorScript, .script, .viewScript, .editorStyle, .style, .render]
            | flatten
            | .[]?
            | select(type == "string" and startswith("file:./"))' "$metadata_file"
    )
done

sha256sum --check docs/block-contracts.sha256

if find . -path ./.git -prune -o -name .DS_Store -print -quit | grep -q .; then
    echo "Repository contains .DS_Store metadata." >&2
    exit 1
fi

echo "All 29 Gutenberg block contracts match the phase 1 baseline."
