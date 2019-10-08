#!/usr/bin/php
<?PHP
    function is_upper($c)
    {
        if ('A' <= $c && $c <= 'Z')
            return true;
        return false;
    }

    function is_alpha($c)
    {
        if (is_upper($c) || ('a' <= $c && $c <= 'z'))
            return true;
        return false;
    }

    function set_flag($c)
    {
        $flag = 2;
        if (is_alpha($c))
        $flag = 0;
        elseif (is_numeric($c))
        $flag = 1;
        return ($flag);
    }

    function ssap2_sort($a, $b)
    {
        echo ($a . " : " . $b . "\n");
        $len_1 = strlen($a);
        $len_2 = strlen($b);
        $a = strtolower($a);
        $b = strtolower($b);
        $max = $len_1;
        if ($len_2 > $len_1)
            $max = $len_1;
        echo "max : " . $max . "\n";
        for ($i = 0; $i < $max; $i++)
        {
            echo "i : " . $i . "\n";
            $c_1 = $a[$i];
            $c_2 = $b[$i];
            echo $c_1 . " : " . $c_2 . "\n";
            $flag_1 = set_flag($c_1);
            $flag_2 = set_flag($c_2);
            echo $flag_1 . " : " . $flag_2 . "\n";
            if ($flag_1 < $flag_2)
                return (-1);
            else if ($flag_2 < $flag_1)
                return (1);
            elseif ($c_1 < $c_2)
                return(-1);
            elseif ($c_2 < $c_1)
                return (1);
            echo "\n";
        }
        return (0);
    }
    function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

    array_shift($argv);
    $string = implode(' ', $argv);
    $arr_strings = explode(' ', $string);
    $arr_filtered = array_filter($arr_strings);
    usort($arr_filtered, "ssap2_sort");
    foreach($arr_filtered as $line)
        echo $line . "\n";
?>