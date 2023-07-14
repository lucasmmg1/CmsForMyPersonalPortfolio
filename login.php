<?php

session_start();

include "connection.php";

if (isset($_SESSION["logged_in"]))
{
}
else
{
    if (isset($_POST['username'], $_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password))
        {
            $error = "All fields are required!";
        }
        else
        {
            $query = $pdo->prepare("SELECT * FROM users WHERE name = ? AND password = ?");
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);
            $query->execute();

            $num = $query->rowCount();

            if ($num == 1)
            {
                $_SESSION['logged_in'] = true;
                header("Location: index.php");
                exit();
            }
            else
            {
                $error = "Incorrect details!";
            }
        }
    }

?>

    <html lang="pt-br">

        <head>
            <link rel="stylesheet" href="Resources/Scripts/CSS/login.css" type="text/css">
            <title> CMS Tutorial </title>
        </head>

        <body class="d-flex m-0 p-0 justify-content-center align-items-center bgcolor_89CFF0">
            <div class="d-flex flex-column mx-0 px-5 py-5 bgcolor_F1F1F1" id="LoginPNL">
                <div class="d-flex flex-column h-15 mx-3 mt-3 mb-0">
                    <h1 class="SegoeUI"> LOGIN </h1>
                    <h5 class="SansationRegular tmpcolor_8d8d8d"> to access the lucasmartinmacedo.com's CMS </h5>
                </div>

                <div class="d-flex flex-column h-80 mx-3 py-auto justify-content-center align-items-center">
                    <form class="d-flex flex-column w-100 h-95 m-0 p-0 justify-content-center align-items-center" action="index.php" method="post" autocomplete="off">
                        <div class="w-100 h-15 mx-0 my-3">
                            <h6 class="h-15 mb-2 tmpcolor_8d8d8d"> EMAIL </h6>
                            <label class="w-100 h-65 mt-1"><input class="w-100 h-100" type="text" name="username" placeholder=""/></label>
                        </div>
                        <div class="w-100 h-15 mx-0 my-3">
                            <h6 class="h-15 mb-2 tmpcolor_8d8d8d"> PASSWORD </h6>
                            <label class="w-100 h-65 mt-1"><input class="w-100 h-100" type="password" name="password" placeholder=""/></label>
                        </div>
                        <div class="w-100 h-20 mx-0 my-3">
                            <input class="w-100 h-50 mx-0 my-3 SegoeUI bgcolor_89CFF0" type="submit" value="login">
                            <?php
                            if (isset($error))
                            {
                                echo "<h6 class='w-100 h-50 text-center fst-italic SansationRegular tmpcolor_8d8d8d'> $error </h6>";
                            }
                            ?>
                        </div>

                    </form>

                </div>

                <div class="d-flex flex-column h-5 mx-3 justify-content-center align-items-center">
                    <h6 class="SansationRegular tmpcolor_8d8d8d"> A <a href="https://lucasmartinmacedo.com" class="tmpcolor_8d8d8d"> lucasmartinmacedo.com</a> domain. </h6>
                </div>
            </div>
        </body>
    </html>

<?php
}