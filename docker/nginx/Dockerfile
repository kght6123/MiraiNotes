FROM nginx:alpine
COPY default.conf /etc/nginx/conf.d/default.conf

RUN apk update \ 
    && apk add --no-cache zlib-dev git curl nodejs npm yarn \
		php7 php7-fpm php7-mcrypt php7-soap php7-openssl php7-gmp php7-pdo_odbc php7-json php7-dom php7-pdo php7-zip php7-mysqli php7-sqlite3 php7-apcu php7-pdo_pgsql php7-bcmath php7-gd php7-odbc php7-pdo_mysql php7-pdo_sqlite php7-gettext php7-xmlreader php7-xmlrpc php7-bz2 php7-iconv php7-pdo_dblib php7-curl php7-ctype php7-phar php7-mbstring php7-tokenizer php7-fileinfo php7-session \
		&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

RUN composer global require "laravel/installer" \
		&& mkdir -p /src \
		&& cd  /src \
		&& git clone https://github.com/kght6123/MiraiNotes.git

WORKDIR /src/MiraiNotes

COPY .env /src/MiraiNotes/.env
COPY credentials.json /src/MiraiNotes/credentials.json

RUN composer install --no-dev \
		&& php artisan key:generate \
		&& php artisan migrate --no-interaction \
		&& yarn install \
		&& yarn run production

COPY www.conf /etc/php7/php-fpm.d/www.conf

# CMDはイメージ作成後に実行される
#CMD /usr/sbin/php-fpm7 --allow-to-run-as-root --nodaemonize or --daemonize
#CMD nginx -g daemon off;
RUN echo $'#!/bin/sh\n\
/usr/sbin/php-fpm7 --allow-to-run-as-root --daemonize\n\
nginx -g "daemon off;"\n\
' > startup.sh \
		&& chmod +x startup.sh

CMD ./startup.sh

#RUN chown -R nginx:nginx /src/MiraiNotes
#USER nginx
