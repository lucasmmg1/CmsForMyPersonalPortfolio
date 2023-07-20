<?php
    include_once "connection.php";
    $conn = new connection("189.100.12.58", "dashboard", "root", "119948b642a772402e9872798a119948b642a772402e9872789a", "3306", "utf8");

    if (isset($_SESSION["logged_in"]))
    {
        readfile("navbar.html");
        if (isset($_POST["logout"]))
            $conn->Logout();
    }
    else
    {
        readfile("login.html");
        if (isset($_POST["login"]))
            $conn->Login();

        $error = $conn->GetError();
        if (isset($error))
        {
            $errorElementClasses = "w-100 h-50 text-center fst-italic SansationRegular tmpcolor_ed4337";
            $errorElement = "<h6 class='" . $errorElementClasses . "'>" . addslashes($error) . "</h6>";
            $errorScript = "<script>document.getElementById('footer').innerHTML += `$errorElement`;</script>";
            echo $errorScript;
        }
    }
?>