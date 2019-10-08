#!/usr/bin/php
<?PHP
    function get_input()
    {
        echo "Enter a number: ";
        $input = trim(fgets(STDIN));
        return ($input);
    }

    $strings = array("even", "odd");
    $input = get_input();
    while (!(feof(STDIN)))
    {
        if (is_numeric($input))
            echo "The number $input is " . $strings[$input % 2] . "\n";
        else
            echo "'$input' is not a number\n";
        
        $input = get_input();
    }
    echo "\n";
?>