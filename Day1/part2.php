<?php

require_once '../utils.php';

class NumberPostion {
    public function __construct(public readonly int $position, public readonly string $value) {}
}

function findTextNumbers(string $line): array {
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
    foreach($numberMap as $key => $val) {
        $pos = 0;
        do {
            $pos = strpos($line, $key, $pos);

            if($pos !== false) {
                $results[] = new NumberPostion($pos, $val);
                $pos++;
            }
        } while ($pos !== false);
    }

    return $results;
}

function findDigitNumbers(string $line): array {
    $results = [];
    for($i = 0; $i < strlen($line); $i++) {
        if(is_numeric($line[$i])) {
            $results[] = new NumberPostion($i, $line[$i]);
        }
    }
    return $results;
}

$firstNumber = fn($str) => array_reduce(array_merge(findTextNumbers($str), findDigitNumbers($str)), fn (?NumberPostion $carry, NumberPostion $item) => $carry && ($carry->position < $item->position) ? $carry : $item)->value;
$lastNumber = fn($str) => array_reduce(array_merge(findTextNumbers($str), findDigitNumbers($str)), fn (?NumberPostion $carry, NumberPostion $item) => $carry && ($carry->position > $item->position) ? $carry : $item)->value;
$combinedNumberInLine = fn($line): int => (int) ($firstNumber($line).$lastNumber($line));

$input = 'input.txt';

$result = 0;

mapOverFile($input, function ($line) use (&$result, $combinedNumberInLine) {
    $result += $combinedNumberInLine($line);
});

println($result);

// 54078