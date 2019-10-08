#!/usr/bin/php
<?PHP
    function ft_split($string) 
    {
        $arr_strings = explode(" ", $string);
        $arr_filtered = array_filter($arr_strings);
        $i = 0;
        foreach ($arr_filtered as $str)
        {
            $arr_return[$i] = $str;
            $i++;
        }
        return ($arr_return);
    }

    function rostring($string)
    {
        $arr_words = ft_split($string);
        $str_first = $arr_words[0];
        array_shift($arr_words);
        foreach ($arr_words as $word)
            echo $word . " ";
        echo $str_first . "\n";
    }

    if ($argv[1])
        rostring($argv[1]);
?>