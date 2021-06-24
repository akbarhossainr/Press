FROM nginx:1.14.0-alpine

RUN rm /etc/nginx/conf.d/*
RUN mkdir -p /var/www/html
ADD docker/nginx/default.conf /etc/nginx/conf.d/
