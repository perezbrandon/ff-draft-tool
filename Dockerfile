FROM webdevops/php-nginx-dev:7.1

COPY _infrastructure/patch-permissions.sh entrypoint.d/patch-permissions.sh
