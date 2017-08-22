FROM webdevops/php:7.1

WORKDIR /app

RUN apt-get update && apt-get install -y cron && \
  ln -sf /proc/1/fd/1 /var/log/cron.log

COPY laravel-cron /etc/cron.d/laravel-cron

RUN crontab /etc/cron.d/laravel-cron
