FROM golang:1.15 AS builder
RUN go get -d -v github.com/mailhog/mhsendmail \
&& cd /go/src/github.com/mailhog/mhsendmail/ \
&& GOOS=linux GOARCH=arm64 go build -o mhsendmail .

FROM php:8.1-fpm
RUN docker-php-ext-install pdo_mysql

COPY --from=builder /go/src/github.com/mailhog/mhsendmail/mhsendmail /usr/local/bin/
RUN chmod +x /usr/local/bin/mhsendmail \
&& echo 'sendmail_path = "/usr/local/bin/mhsendmail --smtp-addr=mailhog:1025"' > /usr/local/etc/php/conf.d/sendmail.ini
