<?php
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

    function is_duplicate($arr_accounts, $new_account)
    {
        foreach ($arr_accounts as $account) 
        {
            if ($account['login'] == $new_account['login'])
            {
                echo "ERROR\n";
                return TRUE;
            }
        }
        return FALSE;
    }
        
    if ($_POST['submit'] && $_POST['submit'] == "OK" && $_POST['login'] && $_POST['passwd'])
    {
        $arr_accounts = get_accounts();
        if (!$arr_accounts)
         $arr_accounts = array();
        $new_account = array();
        $new_account['login'] = $_POST['login'];
        $new_account['passwd'] = hash('whirlpool', $_POST['passwd']);
        if (is_duplicate($arr_accounts, $new_account))
            return ;
        array_push($arr_accounts, $new_account);
        $file = serialize($arr_accounts);
        file_put_contents("../private/passwd", $file);
        echo "OK\n";
    }
    else
        echo "ERROR\n";
?>