<?php
    include_once "Application_Main/Scripts/PHP/Database.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK)
        {
            $fileTmpName = $_FILES["image"]["tmp_name"];
            $file = fopen($fileTmpName, 'r');
            $file_contents = fread($file, filesize($fileTmpName));
            fclose($file);
            $localImage = "data:image/jpeg;base64," . base64_encode($file_contents);
            $file_contents = addslashes($file_contents);

            $query = "UPDATE users SET image = '$file_contents' WHERE username = '".$_SESSION['username']."'";
            $result = Database::GetConnection()->Query($query);

            if ($result) {
                $response = array(
                    "status" => "success",
                    "message" => "Upload da imagem concluído com sucesso.",
                    "image" => $localImage
                );
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Ocorreu um erro ao inserir a imagem no banco de dados.",
                    "image" => null
                );
            }
        }
        else
        {
            $response = array
            (
                "status" => "error",
                "message" => "Ocorreu um erro ao fazer o upload da imagem.",
                "image" => null
            );
        }
    }
    else
    {
        $response = array
        (
            "status" => "error",
            "message" => "Ocorreu um erro ao fazer a requisição POST.",
            "image" => null
        );
    }

    header("Content-Type: application/json");
    echo json_encode($response);
?>