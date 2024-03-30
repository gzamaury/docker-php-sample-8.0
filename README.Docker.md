### Building and running your application

When you're ready, start your application by running:

```shell
  docker compose up --build
```

Your application will be available at http://localhost:8085.

### To open a Terminal in the container use:

```shell
  docker exec -u root -it server-php-sample bash -l
```

### To run the tests use:

```shell
  docker compose run --build --no-deps --rm server ./vendor/bin/phpunit tests/HelloWorldTest.php
```
