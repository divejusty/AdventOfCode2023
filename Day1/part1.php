<?php

require_once '../utils.php';

function findFirstNumber($str) {
    for($i = 0; $i < strlen($str); $i++) {
        if(is_numeric($str[$i])) {
            return $str[$i];
        }
    }
}

function findLastNumber($str) {
    for($i = strlen($str) - 1; $i >= 0; $i--) {
        if(is_numeric($str[$i])) {
            return $str[$i];
        }
    }
}

$input = 'input.txt';

$result = 0;

mapOverFile($input, function ($line) use (&$result) {
    $result += (int) (findFirstNumber($line).findLastNumber($line));
});

println($result);

//54601