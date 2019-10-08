#!/usr/bin/php
<?PHP
    function ft_split($string) 
    {
        $arr_strings = explode(" ", $string);
        $arr_filtered = array_filter($arr_strings);
        sort($arr_filtered, SORT_STRING);
        return ($arr_filtered);
    }
?>