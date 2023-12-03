<?php

namespace AOC2023\Tasks\Day1;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\NumberPosition;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day1Part2 extends BaseTask
{
    public static string $name = "Day 1 Part 2";

    public function run(): void
    {
        $input = File::inputFile('Day1/input.txt'); // 54078

        $result = 0;

        File::mapOverFile($input, function ($line) use (&$result) {
            $result += $this->combinedNumberInLine($line);
        });

        IO::write($result);
    }

    private function combinedNumberInLine(string $line): int
    {
        $firstNumber = fn($str) => array_reduce(array_merge($this->findTextNumbers($str), $this->findDigitNumbers($str)), fn (?NumberPosition $carry, NumberPosition $item) => $carry && ($carry->position < $item->position) ? $carry : $item)->value;
        $lastNumber = fn($str) => array_reduce(array_merge($this->findTextNumbers($str, true), $this->findDigitNumbers($str, true)), fn (?NumberPosition $carry, NumberPosition $item) => $carry && ($carry->position < $item->position) ? $carry : $item)->value;
        return (int) ($firstNumber($line) . $lastNumber($line));
    }

    private function findTextNumbers(string $line, bool $reverse = false): array {
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

    private function findDigitNumbers(string $line, bool $reverse = false): array {
        $line = $reverse ? strrev($line) : $line;
        for($i = 0; $i < strlen($line); $i++) {
            if(is_numeric($line[$i])) {
                return [new NumberPosition($i, $line[$i])];
            }
        }
        return [];
    }
}