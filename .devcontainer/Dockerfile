# [Choice] PHP version (use -bullseye variants on local arm64/Apple Silicon): 8 / 8-bookworm, 8.3 / 8.3-bookworm, 8.2 / 8.2-bookworm, 8.1 / 8.1-bookworm, 8-bullseye, 8.3-bullseye, 8.2-bullseye, 8.1-bullseye, 8-buster, 8.2-buster, 8.1-buster
ARG VARIANT=1-8.1-bookworm
FROM mcr.microsoft.com/vscode/devcontainers/php:${VARIANT}

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client \ 
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install php-mysql driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1

