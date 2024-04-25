<?php

// In a devcontainer just run the test in the Testing secction.
// To run this test out of a devcontainer, we can run:
//    docker compose run --build --no-deps --rm server ./vendor/bin/phpunit tests/HelloWorldTest.php

// Retrieve the value of the environment variable defined in docker-compose.yml
$_ENV['APP_TARGET_FOLDER_'] = getenv('APP_TARGET_FOLDER') ?: '';

require_once $_ENV['APP_TARGET_FOLDER_'] . 'hello.php';

class HelloWorldTest extends PHPUnit\Framework\TestCase
{
    public function testOutput()
    {
        // Capture the output of hello.php
        ob_start();
        include $_ENV['APP_TARGET_FOLDER_'] . 'hello.php';
        $output = ob_get_clean();

        // Assert that the output is "Hello, Docker!"
        $this->assertEquals("Hello, Docker!", $output);
    }
}
