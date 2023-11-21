<?php
    require_once __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    include_once "connection.php";
    $conn = new connection(getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_PORT'), getenv('DB_CHARSET'));

    $query = "SELECT image FROM users WHERE username = '".$_SESSION['username']."'";
    $result = $conn->Query($query);
    if ($result && $result->rowCount() > 0)
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $imgContent = $row['image'];

        $response = array
        (
            "status" => "success",
            "image" => "data:image/jpeg;base64," . base64_encode($imgContent)
        );
    }
    else
    {
        $response = array
        (
            "status" => "error",
            "message" => "Imagem não encontrada."
        );
    }

    header("Content-Type: application/json");
    echo json_encode($response);
?>