<?php

    require_once "DBConstants.php";

    class DBConnection{

        private static $connect = null;
        private $conn;

        private function __construct()
        {
            $this->conn = new mysqli(DBConstants::$DB_HOST,DBConstants::$DB_USER,DBConstants::$DB_PASSWORD,DBConstants::$DB_SCHEMA);
        }

        public static function get_instance()
        {
            global $connect;
            if(is_null($connect))
                $connect = new DBConnection();

            return $connect;
        }

        public function get_connection()
        {
            return $this->conn;
        }

        function __destruct()
        {
            $this->conn->close();
        }
    }

?>