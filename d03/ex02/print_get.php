<?php
    if ($_GET)
    {
        $arr = ($_GET);
        $arr_keys = array_keys($_GET);
        $i = 0;
        foreach($arr as $str)
        {
            print($arr_keys[$i] . ": " . $str . "\n");
            $i++;
        }
    }
?>