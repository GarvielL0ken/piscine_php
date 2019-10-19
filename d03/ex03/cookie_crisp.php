<?php
if ($_GET)
{
    if ($_GET['action'])
    {
        if ($_GET['action'] == 'set' && $_GET['name'] && $_GET['value'])
            setcookie($_GET['name'], $_GET['value'], time() + 86400, '/');
        if ($_GET['action'] == 'get' && $_GET['name'])
            echo $_COOKIE[$_GET['name']] . "\n";
        if ($_GET['action'] == 'del' && $_GET['name'])
            setcookie($_GET['name'], '', time() - 1, '/');
    }
}
?>
