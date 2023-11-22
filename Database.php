<?php
    require_once __DIR__ . '/vendor/autoload.php';
    include_once "connection.php";
    session_start();

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
            }

            return Database::$conn;
        }
    }