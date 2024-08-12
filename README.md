# docker-php-sample

A simple PHP web application example based on [Docker's PHP Language Guide](https://docs.docker.com/language/php/).

Start the PHP Server:

```shell
  php -c src -S 127.0.0.1:8080 -t src
```

or with Apache, recommended due the .htaccess config:

```shell
  apache2ctl start
```