<?php

function getcsv($id, $value)
{
    $f = fopen('php://memory', 'r+');
    fputcsv($f, array($id, $value), ";");
    rewind($f);
    return stream_get_contents($f);
}

if (isset($_GET["id"]) && isset($_GET["value"]))
{
    $lines = file('list.csv');
    $i = 0;

    foreach ($lines as $key => $line) {
        $lines[$key] = trim($line, "\n");
    }

    $csvline = trim(getcsv($_GET["id"], $_GET["value"]), "\n");

    while (str_getcsv($lines[$i], ";")[0] > $_GET["id"])
        $i++;

    array_splice($lines, $i, 0, $csvline);
    file_put_contents('list.csv', implode(PHP_EOL, $lines));
    print("OK" . PHP_EOL);
}
else
    print("No ID or Value" . PHP_EOL);


?>
