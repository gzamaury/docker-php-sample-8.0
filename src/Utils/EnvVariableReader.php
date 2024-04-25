<?php

namespace Utils;

use Dotenv\Dotenv;
use ErrorException;

class EnvVariableReader
{
    protected static $envVariables = [];

    public static function getEnvVariable($varName)
    {
        // Path of the .htaccess file
        $htaccessFilePath = __DIR__ . '/../.htaccess';

        // Check if the variable has already been loaded
        if (!isset(self::$envVariables[$varName])) {
            // If not, load the .env file
            self::loadEnvVariables();
        }

        if (file_exists($htaccessFilePath) && isset($_SERVER[$varName])) {
            self::$envVariables[$varName] = $_SERVER[$varName];
        } elseif (getenv($varName) != false) {
            self::$envVariables[$varName] = getenv($varName);
        }

        // Check if the variable exists in the loaded variables
        if (!isset(self::$envVariables[$varName])) {
            throw new ErrorException("The environment variable '{$varName}' has not been defined.");
        }

        // Return the value of the environment variable
        return self::$envVariables[$varName];
    }

    protected static function loadEnvVariables()
    {
        // Path of the .env file
        $dotenvFilePath = __DIR__ . '/../.env';

        // Check if the .env file exists before loading it
        if (file_exists($dotenvFilePath)) {
            // Load environment variables from the .env file
            $dotenv = Dotenv::createMutable(__DIR__ . '/../');
            $dotenv->load();

            // Store the loaded variables in the static property
            self::$envVariables = $_ENV;
        }
    }

    public static function getPassFromEnvVarFile($envVarFilePath)
    {
        $filePath = EnvVariableReader::getEnvVariable($envVarFilePath);
        // Read the password from the file
        return trim(file_get_contents(__DIR__ . "/../" . $filePath));
    }
}
