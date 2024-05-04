<?php

namespace Utils\paginator;

use Services\DBService;

class DataSource
{
    protected static $conn = null;

    public static function getConnection()
    {
        if (is_null(self::$conn)) {
            $DBService = new DBService();
            self::$conn = $DBService->conexion();
        }

        return self::$conn;
    }

    public static function runQuery($query)
    {
        $result = mysqli_query(self::getConnection(), $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }

    public static function numRowsOf($query)
    {
        $result  = mysqli_query(self::getConnection(), $query);
        $rowcount = mysqli_num_rows($result);

        return $rowcount;
    }

    public static function closeConn()
    {
        self::$conn->close();
        self::$conn = null;
    }
}
