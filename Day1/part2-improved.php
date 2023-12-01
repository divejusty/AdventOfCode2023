<?php

require_once '../utils.php';

class NumberPosition {
    public function __construct(public readonly int $position, public readonly string $value) {}
}

function findTextNumbers(string $line, bool $reverse = false): array {
    $results = [];
    $numberMap = [
        'one' => '1',
        'two' => '2',
        'three' => '3',
        'four' => '4',
        'five' => '5',
        'six' => '6',
        'seven' => '7',
        'eight' => '8',
        'nine' => '9',
    ];
    $line = $reverse ? strrev($line) : $line;
    foreach($numberMap as $key => $val) {
        $pos = strpos($line, $reverse ? strrev($key) : $key);
        if($pos !== false) {
            $results[] = new NumberPosition($pos, $val);
        }
    }

    return $results;
}

function findDigitNumbers(string $line, bool $reverse = false): array {
    $line = $reverse ? strrev($line) : $line;
    for($i = 0; $i < strlen($line); $i++) {
        if(is_numeric($line[$i])) {
            return [new NumberPosition($i, $line[$i])];
        }
    }
    return [];
}

$firstNumber = fn($str) => array_reduce(array_merge(findTextNumbers($str), findDigitNumbers($str)), fn (?NumberPosition $carry, NumberPosition $item) => $carry && ($carry->position < $item->position) ? $carry : $item)->value;
$lastNumber = fn($str) => array_reduce(array_merge(findTextNumbers($str, true), findDigitNumbers($str, true)), fn (?NumberPosition $carry, NumberPosition $item) => $carry && ($carry->position < $item->position) ? $carry : $item)->value;
$combinedNumberInLine = fn($line): int => (int) ($firstNumber($line).$lastNumber($line));

$input = 'input.txt';

$result = 0;

mapOverFile($input, function ($line) use (&$result, $combinedNumberInLine) {
    $result += $combinedNumberInLine($line);
});

println($result);

// 54078