<?php

session_start();

include_once "connection.php";

if (isset($_SESSION["logged_in"]))
{
}
else
{
    ?>

    <html lang="pt-br">

        <head>

            <!-- region Meta Tags -->
            <meta charset="UTF-8">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <link rel="stylesheet" href="/Application_main/Scripts/CSS/style.css" type="text/css">
            <link rel="stylesheet" href="/Application_main/Scripts/CSS/boostrap-plus.css" type="text/css">
            <!-- endregion -->

            <title>CMS Editor</title>

        </head>

        <body>
            <div class="container">
                <a href="/index.php" id="logo"> CMS </a>

                <form action="/index.php" method="post" autocomplete="off">
                    <label><input type="text" name="username" placeholder="username"/></label>
                    <label><input type="password" name="password" placeholder="password"/></label>
                    <input type="submit" value="Login">
                </form>
            </div>
        </body>
    </html>

    <?php
}