<?php

    # $hostname = "localhost";
    # $hostname = "192.168.0.175";
    $hostname = "189.100.12.58";
    $dbname = "cms";
    $username = "root";
    $password = "119948b642a772402e9872798a119948b642a772402e9872789a";
    $port = "3306";
    $charset = 'utf8mb4';

    $options =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];

    $dsn = "mysql:host=$hostname:$port;dbname=$dbname;charset=$charset";

    try
    {
        $pdo = new PDO($dsn, $username, $password, $options);
    }
    catch (PDOException $e)
    {
        die("Error ". $e->getCode() . ": Could not connect to the database $dbname: " . $e->getMessage());
    }