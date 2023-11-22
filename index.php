<?php
    include_once "Database.php";

    if (isset($_POST["logout"]))
        Database::GetConnection()->Logout();

    if (isset($_POST["login"]))
        Database::GetConnection()->Login();

    if (isset($_SESSION["logged_in"]))
    {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                <link rel="stylesheet" href="Application_Main/Scripts/CSS/boostrap-plus.css" type="text/css">
                <link rel="stylesheet" href="Application_Main/Scripts/CSS/style.css" type="text/css">
                <link rel="stylesheet" href="Application_Main/Scripts/CSS/header.css" type="text/css">

                <link href='Application_Main/Sprites/faviconIMG.ico' rel='icon'>
                <title> CMS Editor </title>
            </head>

            <body class="d-flex flex-column vw-100 vh-100 m-0 p-0 bgcolor_f7f7f7">
                <?php include "Application_Main/Scripts/HTML/header.html";?>
                <?php include "Application_Main/Scripts/HTML/navbar.html";?>

                <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
                <script src="https://kit.fontawesome.com/3c6c4efe58.js" crossorigin="anonymous"></script>
                <script src="Application_Main/Scripts/JS/script.js"></script>
            </body>
        </html>
        <?php

        echo "<script>document.getElementById('titleTMP').innerHTML = 'Bem-vindo, ".$_SESSION['username']."!'</script>";
    }
    else
    {
        readfile("Application_Main/Scripts/HTML/login.html");

        $error = Database::GetConnection()->error;
        if (isset($error))
        {
            $errorElementClasses = "w-100 h-50 text-center fst-italic SansationRegular tmpcolor_ed4337";
            $errorElement = "<h6 class='" . $errorElementClasses . "'>" . addslashes($error) . "</h6>";
            $errorScript = "<script>document.getElementById('footer').innerHTML += `$errorElement`;</script>";
            echo $errorScript;
        }
    }
?>