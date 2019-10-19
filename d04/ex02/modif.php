<?php
    function valid_input()
    {
        if ($_POST['submit'] && $_POST['submit'] == "OK" && $_POST['login'] && $_POST['oldpw'] && $_POST['newpw'])
            return (TRUE);
        return (FALSE);
    }
    function get_accounts()
    {
        $flag_mkdir = 0;
        if (!file_exists("../private"))
        {
            mkdir("../private");
            $flag_mkdir = 1;
        }
        if (!file_exists("../private/passwd") || $flag_mkdir == 1)
            return (FALSE);   
        $file = file_get_contents("../private/passwd");
        $arr_accounts = unserialize($file);
        return ($arr_accounts);
    }

    if (!valid_input())
    {
        echo "ERROR\n";
        return ;
    }
    $arr_accounts = get_accounts();
    if (!$arr_accounts)
    {
        echo "ERROR\n";
        return ;
    }
    $new_account = array();
    $new_account['login'] = $_POST['login'];
    $new_account['oldpw'] = hash('whirlpool', $_POST['oldpw']);
    $new_account['newpw'] = hash('whirlpool', $_POST['newpw']);
    $i = 0;
    while ($arr_accounts[$i])
    {
        if ($arr_accounts[$i]['login'] == $new_account['login'])
        {
            if ($arr_accounts[$i]['passwd'] == $new_account['oldpw'])
                $arr_accounts[$i]['passwd'] = $new_account['newpw'];
            else
            {
                echo "ERROR\n";
                return ;
            }
            break ;
        }
        $i++;
    }
    if (!$arr_accounts[$i])
    {
        echo "ERROR\n";
        return ;
    }
    $file = serialize($arr_accounts);
    file_put_contents("../private/passwd", $file);
    echo "OK\n";
?>