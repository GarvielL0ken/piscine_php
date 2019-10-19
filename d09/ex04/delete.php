<?php

if (isset($_GET["id"]))
{
    $lines = file('list.csv');
    $gotelem = 0;

    foreach ($lines as $key => $line) {
        if (str_getcsv($line, ";")[0] == $_GET["id"])
        {
            unset($lines[$key]);
            $gotelem = 1;
        }
        else
        {
            $lines[$key] = trim($line, "\n");
        }
    }
    if ($gotelem === 1)
    {
        file_put_contents('list.csv', implode(PHP_EOL, $lines));
        print("OK" . PHP_EOL);
    }
    else
        print("Key Not Found" . PHP_EOL);
}
else
    print("Invalid ID" . PHP_EOL);


?>
