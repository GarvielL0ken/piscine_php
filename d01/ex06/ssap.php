#!/usr/bin/php
<?PHP
    array_shift($argv);
    $string = implode(' ', $argv);
    $arr_strings = explode(' ', $string);
    $arr_filtered = array_filter($arr_strings);
    sort($arr_filtered, SORT_STRING);
    foreach($arr_filtered as $line)
        echo $line . "\n";
?>