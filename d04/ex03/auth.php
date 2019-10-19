<?php
    function get_users()
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

    function auth($login, $passwd)
    {
        $arr_users = get_users();
        foreach ($arr_users as $user)
        {
            if ($user['login'] == $login && hash('whirlpool', $passwd))
                return TRUE;
        }
        return FALSE;
    }
?>