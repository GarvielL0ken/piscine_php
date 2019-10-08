#!/usr/bin/php
<?PHP
    function first_elem($array)
    {
        foreach ($array as $str)
            return ($str);
    }

    function ft_is_sort($arr_input)
    {

        $prev = first_elem($arr_input);
        array_shift($arr_input);
        foreach ($arr_input as $current)
        {
            if (strcmp($prev, $current) > 0)
                return (false);
            $prev = $current;
        }
        return (true);
    }
?>