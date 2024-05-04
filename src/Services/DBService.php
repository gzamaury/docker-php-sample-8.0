<?php

namespace Services;

use Utils\EnvVariableReader;
use Mysqli;

class DBService
{
    public function conexion()
    {
        $servername = EnvVariableReader::getEnvVariable('DB_HOST');
        $username = EnvVariableReader::getEnvVariable('DB_USER');
        $dbname = EnvVariableReader::getEnvVariable('DB_NAME');
        $password = EnvVariableReader::getPassFromEnvVarFile('DB_PASSWORD_FILE_PATH');

        // Create connection
        $conn = new Mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");

        return $conn;
    }
}
