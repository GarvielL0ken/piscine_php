#!/usr/bin/php
<?php
    function validate($string)
    {
        $day = "([ll]undi|[Mm]ardi|[Mm]ercredi[Jj]eudi[Vv]endredi[Ss]amedi[Dd]imanche)";
        $month = "([Jj]aniver|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre)";
        $time = "\d\d:\d\d:\d\d";
        $pattern = "/^$day ([0-2][0-9]|[0-9]|3[0-1]) $month [0-9]{4} $time$/";
        return(preg_match($pattern, $string));
    }

    function get_month($string)
    {
        $months = array("/[Jj]aniver/", "/[Ff]evrier/", "/[Mm]ars/", "/[Aa]vril/", "/[Mm]ai/", "/[Jj]uin/", "/[Jj]uillet/", "/[Aa]out/", "/[Ss]eptembre/", 
                        "/[Oo]ctobre/", "/[Nn]ovembre/", "/[Dd]ecembre/");
        $arr_ints = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $return = preg_replace($months, $arr_ints, $string);
        if ($return == $string)
            return("");
        else
            return($return);
    }

    if ($argv[1])
    {
        if (validate($argv[1]) && substr_count($argv[1], " ") == 4)
        {
            date_default_timezone_set("Europe/Paris");
            $arr_format = explode(' ', $argv[1]);
            array_shift($arr_format);
            $month = get_month($arr_format[1]);
            
            $arr_day = explode(':', $arr_format[3]);
            print(mktime($arr_day[0], $arr_day[1], $arr_day[2], $month, $arr_format[0] ,$arr_format[2]) . "\n");
        }
        else
            echo "Wrong Format\n";
    }
?>