FROM php:7.4.3-apache

ARG HOST_UID
ARG HOST_USER

# Install general dependencies
RUN apt-get update \
 && apt-get install -y sudo

# Install php dependencies
RUN apt-get install -y \
  mariadb-client \
  libpng-dev \
  libjpeg-dev \
  libonig-dev

RUN docker-php-ext-install gd \
 && docker-php-ext-install mbstring \
 && docker-php-ext-install mysqli

# Install wp-cli && dependencies
RUN apt-get install -y less
RUN curl -L https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /usr/local/bin/wp \
 && chmod +x /usr/local/bin/wp

# Install and configure mhsendmail
# Source: https://blog.philipphauer.de/test-mail-server-php-docker-container/
RUN apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/*
RUN curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf -
ENV PATH /usr/local/go/bin:$PATH
RUN go get github.com/mailhog/mhsendmail
RUN cp /root/go/bin/mhsendmail /usr/bin/mhsendmail
RUN echo 'sendmail_path = /usr/bin/mhsendmail --smtp-addr mailhog:1025' > /usr/local/etc/php/php.ini

# Set Apache modules
RUN a2enmod rewrite headers

# Add host user to container to allow read/write by host and container
RUN useradd -u $HOST_UID --create-home -s /bin/bash $HOST_USER
