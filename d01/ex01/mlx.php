#!/usr/bin/php
<?PHP
    function print_line()
    {
        for ($i = 0; $i < 100; $i++)
        {
            echo "X";
        }
        echo "\n";
    }
    for ($i = 0; $i < 10; $i++)
    {
        print_line();
    }
?>