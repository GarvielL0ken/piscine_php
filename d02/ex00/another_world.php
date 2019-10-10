#!/usr/bin/php
<?php
    function remove_white_space($str)
    {
        $pattern = array('/\t/', '/\s+/');
        $pattern_2 = array('/^ /', '/ $/');
        $return = (preg_replace($pattern, ' ', $str));
        $return = (preg_replace($pattern_2, '', $return));
        return ($return);
    }

    if ($argv[1])
    {
        $str = remove_white_space($argv[1]);
        echo $str . "\n";
    }
?>