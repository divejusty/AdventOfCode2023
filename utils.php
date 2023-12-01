<?php

function println($str) {
    print($str."\n");
}

function mapOverFile($fileName, $callback) {
    $file = fopen($fileName, 'r');
    while($line = fgets($file)) {
        $callback($line);
    }
    fclose($file);
}