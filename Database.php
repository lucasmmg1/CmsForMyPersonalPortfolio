<?php
    require_once __DIR__ . '/vendor/autoload.php';
    session_start();
    include_once "Application_Main/Scripts/PHP/connection.php";

    class Database
    {
        private static $conn;

        public static function GetConnection()
        {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            if (!isset(Database::$conn))
            {
                Database::$conn = new connection(getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_PORT'), getenv('DB_CHARSET'));
                //Database::$conn = new connection("179.209.42.16", "dashboard", "dashboard", "119948b642a772402e9872798a119948b642a772402e9872789a", "3306", "utf8");
            }

            return Database::$conn;
        }
    }