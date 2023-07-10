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