<?php
    include("auth.php");
    session_start();

    if (auth($_SESSION['login'], $_SESSION['passwd']))
    {
        $_SESSION['loggued_on_user'] = $_SESSION['login'];
        echo "OK\n";
    }
    else
    {
        $_SESSION['loggued_on_user'] = "";
        echo "ERROR\n";
    }
?>