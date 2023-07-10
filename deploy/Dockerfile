FROM serversideup/php:8.1-fpm-nginx

# Set environment variables
ENV SSL_MODE="mixed"

ENV FFMPEG_BINARIES="/usr/bin/ffmpeg"
ENV FFPROBE_BINARIES="/usr/bin/ffprobe"

# PHP overrides

ENV PHP_OPEN_BASEDIR="$WEBUSER_HOME:/dev/stdout:/tmp:/usr/bin:/dev/null"
ENV PHP_POST_MAX_SIZE=0
ENV PHP_UPLOAD_MAX_FILE_SIZE=0
ENV PHP_MAX_EXECUTION_TIME=0

# TODO: git, supervisor?
RUN apt-get update && apt-get install -y \
    ffmpeg \
# Clean up
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#   && npm run prod

# Copy S6 configs
COPY --chmod=755 ./deploy/s6-overlay/ /etc/s6-overlay/
COPY --chown=1000:1000 . /var/www/html

#RUN composer install --no-interaction --optimize-autoloader --no-dev
#RUN composer install --no-interaction --optimize-autoloader

EXPOSE 80

CMD ["su", "webuser", "-c", "php artisan queue:listen --tries=3 --timeout=3600"]
