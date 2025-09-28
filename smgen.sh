#!/usr/bin/env bash

set -euo pipefail

if [ -f .smgen-rc ]; then
	source .smgen-rc
fi

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

case "$1" in
	init)
		if [ ! -z "$(ls -A ./)" ]; then
			echo "Directory is not empty."
			exit 1
		fi;

		mkdir docs/
		mkdir pages/
		mkdir static/
		mkdir templates/

		cp "${SCRIPT_DIR}/templates/page.php" "${SCRIPT_DIR}/templates/header.php" "${SCRIPT_DIR}/templates/footer.php" templates/
		cp "${SCRIPT_DIR}/static/default.css" "${SCRIPT_DIR}/static/main.js" static/
		cp "${SCRIPT_DIR}/.smgen-rc-default" ./.smgen-rc

		PAGE_URL="https://jaspervdj.be/lorem-markdownum/markdown.txt?p=5"
		curl "${PAGE_URL}" -o ./pages/index.md
		;;

	build)
		if [ -f before-smgen.sh ]; then
			before-smgen.sh
		fi

		OUTPUT_DIR=${OUTPUT_DIR:-"./docs"}
		TEMPLATE_DIR=${TEMPLATE_DIR:-"./templates"}
		STATIC_DIR=${STATIC_DIR:-"./static"}
		PAGES_DIR=${PAGES_DIR:-"./pages"}

		PHP=${PHP:-"php"}
		PANDOC=${PANDOC:-"pandoc"}
		YQ=${YQ:-"yq"}

		BASE_URL=${BASE_URL:-""}
		PRODUCT_NAME=${PRODUCT_NAME:-""}
		ORGANIZATION=${ORGANIZATION:-""}
		TAGLINE=${TAGLINE:-""}

		PHP_FLAGS='-d display_errors=stderr -d include_path="'${SCRIPT_DIR}/helpers'"'

		STYLES=${STYLES:-""}
		INLINE_STYLES=${INLINE_STYLES:-""}

		JAVASCRIPTS=${JAVASCRIPTS:-""}
		INLINE_JAVASCRIPTS=${INLINE_JAVASCRIPTS:-""}
		BODY_JAVASCRIPTS=${BODY_JAVASCRIPTS:-""}
		INLINE_BODY_JAVASCRIPTS=${INLINE_BODY_JAVASCRIPTS:-""}

		TITLE_PREFIX=${TITLE_PREFIX:-""}

		if [ "${TITLE_PREFIX}" != "" ]; then
			TITLE_PREFIX="--title-prefix=${TITLE_PREFIX}"
		fi

		HIGHLIGHT_STYLE=${HIGHLIGHT_STYLE:-"zenburn"};

		if [ "${HIGHLIGHT_STYLE}" != "" ]; then
			HIGHLIGHT_STYLE="--highlight-style ${HIGHLIGHT_STYLE}"
		fi

		if ! command -v "${PHP}" >/dev/null 2>&1; then
			echo "php is required."
			exit 1
		fi

		if ! command -v "${YQ}" >/dev/null 2>&1; then
			echo "yq is required."
			exit 1
		fi

		if ! command -v "${PANDOC}" >/dev/null 2>&1; then
			echo "pandoc is required."
			exit 1
		fi

		if [ ! -z "$(ls -A ./)" ]; then
			echo -e "\e[33;4mCopying static assets...\e[0m"
			cp -rfv "${STATIC_DIR}/"* "${OUTPUT_DIR}/";
		fi

		echo -e "\e[33;4mBuilding pages...\e[0m"

		STYLE_ARGS=""
		INLINE_STYLE_ARGS=""

		if [[ -n "${STYLES}" ]]; then
			while IFS= read -r STYLE; do
				STYLE_ARGS+="--css ${STYLE} "
			done <<< "${STYLES}"
		fi

		if [[ -n "${INLINE_STYLES}" ]]; then
			while IFS= read -r INLINE_STYLE; do
				INLINE_STYLE_ARGS+="-H ${INLINE_STYLE} "
			done <<< "${INLINE_STYLES}"
		fi

		find "${PAGES_DIR}" -type f -print0 | while IFS= read -r -d $'\0' PAGE_FILE; do {

			DIR=$( dirname "${PAGE_FILE}" );
			BASE=$( basename "${PAGE_FILE}" );
			EXT="${BASE##*.}"
			PAGE_NAME="${BASE%.*}"
			DEST="${DIR#"${PAGES_DIR}"}/${PAGE_NAME}.html"
			DEST_JSON="${DIR#"${PAGES_DIR}"}/${PAGE_NAME}.json"

			# Skip directory-level frontmatter
			if [ "${PAGE_NAME}.${EXT}" == ".fm.yaml" ]; then
				continue;
			fi

			echo -e "\e[37m  ${PAGE_FILE}...\e[0m"

			# Check if the file has frontmatter
			HAS_FM=
			FIRST_LINE=$(head -n 1 "${PAGE_FILE}")
			if [[ "${FIRST_LINE}" == "---" ]]; then
				HAS_FM=1
			fi

			# Make sure the matching subdirectory exists
			mkdir -p "${OUTPUT_DIR}/${DIR#"${PAGES_DIR}"}"

			# Determine the template
			if [ "${HAS_FM}" == "1" ]; then
				TEMPLATE=$( "${YQ}" --front-matter=extract '.template' "${PAGE_FILE}" )
			else
				TEMPLATE=${TEMPLATE_DIR}/page.php
			fi

			# Template fallback logic
			if [ "${TEMPLATE}" == "null" ] || [ "${TEMPLATE}" == "" ]; then
				TEMPLATE=${TEMPLATE_DIR}/page.php

				# Check for a .php template for the current file's extension
				if [ -f "${TEMPLATE_DIR}/${EXT}-page.php" ]; then
					TEMPLATE=${TEMPLATE_DIR}/${EXT}-page.php
				fi

				# Check for a .html template for the current file's extension
				if [ -f "${TEMPLATE_DIR}/${EXT}-template.html" ]; then
					TEMPLATE=${TEMPLATE_DIR}/${EXT}-template.html
				fi
			fi

			# Table of contents
			TOC_FLAG=
			if [ "${HAS_FM}" == "1" ]; then
				TOC=$( "${YQ}" --front-matter=extract '.TOC' "${PAGE_FILE}" )
				if [ "${TOC}" == "null" ] || [ "${TOC}" == "" ] || [ "${TOC}" == "true" ]; then
					TOC_FLAG=--toc
				fi
			else
				TOC_FLAG=--toc
			fi

			TMP_FILE=/tmp/$( uuid ).html

			# Build the final template
			PRODUCT_NAME=${PRODUCT_NAME}\
			TAGLINE=${TAGLINE}\
			ORGANIZATION=${ORGANIZATION}\
			BASE_URL=${BASE_URL}\
			PAGES_DIR=${PAGES_DIR}\
			JAVASCRIPTS=${JAVASCRIPTS}\
			INLINE_JAVASCRIPTS=${INLINE_JAVASCRIPTS}\
			BODY_JAVASCRIPTS=${BODY_JAVASCRIPTS}\
			INLINE_BODY_JAVASCRIPTS=${INLINE_BODY_JAVASCRIPTS}\
			CURRENT_PAGE=${DEST}\
			"${PHP}" ${PHP_FLAGS} "${TEMPLATE}" "${PAGE_FILE}" > "${TMP_FILE}"

			# Build the HTML
			"${PANDOC}" --data-dir=. -s -f markdown -t html \
				${HIGHLIGHT_STYLE} ${TOC_FLAG} ${TITLE_PREFIX} \
				--template="${TMP_FILE}" \
				${INLINE_STYLE_ARGS} \
				${STYLE_ARGS} \
				-o "${OUTPUT_DIR}/${DEST}" \
				"${PAGE_FILE}"

			# Cleanup
			rm ${TMP_FILE}

		}; done;

		echo -e "\e[33;4mAssembing sitemap...\e[0m"
		echo -e "\e[37m  ${OUTPUT_DIR}/sitemap.xml...\e[0m"
		"${PHP}" ${PHP_FLAGS} "${SCRIPT_DIR}/helpers/sitemap.php" "${BASE_URL}" > "${OUTPUT_DIR}/sitemap.xml"

		if [ -f after-smgen.sh ]; then
			after-smgen.sh
		fi
		;;
	serve)
		php -S localhost:8000 -t docs/
		;;
	create-random-page)
		PAGE_URL="https://jaspervdj.be/lorem-markdownum/markdown.txt?p=5"
		PAGE_FILE="pages/$(shuf -n 1 /usr/share/dict/words).md"
		if [ -e "${PAGE_FILE}"} ]; then
			echo "File exists: ${PAGE_FILE}"
			exit 1
		fi
		curl "${PAGE_URL}" -o ${PAGE_FILE}
esac
