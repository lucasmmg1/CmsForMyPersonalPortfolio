<?php
    include_once "Database.php";

    $query = "SELECT image FROM users WHERE username = '".$_SESSION['username']."'";
    $result = Database::GetConnection()->Query($query);
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