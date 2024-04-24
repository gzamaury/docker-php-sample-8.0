<?php

namespace pagination;

use Utils\EnvVariableReader;

class DataSourcePaginator
{
    protected $conn = null;

    /**
     * PHP implicitly takes care of cleanup for default connection types.
     * So no need to worry about closing the connection.
     *
     * Singletons not required in PHP as there is no
     * concept of shared memory.
     * Every object lives only for a request.
     *
     * Keeping things simple and that works!
     */
    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getConnection()
    {
        if (is_null($this->conn)) {
            $host = EnvVariableReader::getEnvVariable('DB_HOST');
            $user = EnvVariableReader::getEnvVariable('DB_USER');
            $database = EnvVariableReader::getEnvVariable('DB_NAME');
            $passwordFilePath = EnvVariableReader::getEnvVariable('DB_PASSWORD_FILE_PATH');
            $password = trim(file_get_contents($passwordFilePath));
            $conn = mysqli_connect($host, $user, $password, $database);

            if (mysqli_connect_errno()) {
                trigger_error("Problem with connecting to database.");
            }

            $conn->set_charset("utf8");
        }

        return $conn;
    }

    public function runQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }

    public function numRows($query)
    {
        $result  = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);

        return $rowcount;
    }
}
