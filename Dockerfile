FROM php:7.2-apache

RUN apt-get update && apt-get install ssl-cert
RUN a2enmod ssl && a2ensite default-ssl
