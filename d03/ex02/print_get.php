<?php
    if ($_GET)
    {
        $arr = ($_GET);
        foreach($arr as $key => $str)
            print($key . ": " . $str . "\n");
    }
?>