#!/usr/bin/php
<?PHP
    function ft_split($string) 
    {
        $arr_strings = explode(" ", $string);
        $count = count($arr_strings);
        $arr_filtered = array_filter($arr_strings);
        $j = 0;
        for ($i = 0; $i < $count; $i++)
        {
            if (strlen($arr_filtered[$i]))
            {
                $arr_return[$j] = $arr_filtered[$i];
                $j++;
            }
        }
        return ($arr_return);
    }

    if ($argv[1])
    {
        $arr_strings = ft_split($argv[1]);
        $i = 0;
        while ($arr_strings[$i])
        {
            if ($arr_strings[$i + 1])
                $c = " ";
            else
                $c = "\n";
            echo $arr_strings[$i] . $c;
            $i++;
        }
    }
?>