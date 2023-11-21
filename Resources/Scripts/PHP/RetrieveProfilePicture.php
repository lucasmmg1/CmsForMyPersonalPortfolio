<?php
    include_once "connection.php";

    $conn = new connection("189.100.12.58", "dashboard", "root", "119948b642a772402e9872798a119948b642a772402e9872789a", "3306", "utf8");
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