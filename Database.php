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
                Database::$conn = new connection($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_PORT'], $_ENV['DB_CHARSET']);
                //Database::$conn = new connection("179.209.42.16", "dashboard", "dashboard", "119948b642a772402e9872798a119948b642a772402e9872789a", "3306", "utf8");
            }

            return Database::$conn;
        }
    }