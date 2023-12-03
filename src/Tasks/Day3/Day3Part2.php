<?php

namespace AOC2023\Tasks\Day3;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\SymbolCoordinates;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day3Part2 extends BaseTask
{
    public static string $name = "Day 3 Part 2";

    public function run(): void
    {
        // Training 2: 467835
        $inputFile = File::inputFile('Day3/training2.txt');

        // input: 72246648
        $inputFile = File::inputFile('Day3/input.txt');

        $inputMatrix = File::readAsMatrix($inputFile);

        $numbers = $this->parseSymbols($inputMatrix);

        $result = array_reduce($numbers, fn(int $carry, int $item) => $carry + $item, 0);

        IO::write("$result");
    }

    private function parseSymbols(array $matrix): array
    {
        $results = [];
        $carry = "";
        for ($r = 0; $r < count($matrix); $r++) {
            for ($c = 0; $c < count($matrix[$r]); $c++) {
                if (is_numeric($matrix[$r][$c])) {
                    $carry .= $matrix[$r][$c];
                    continue;
                }

                if (in_array($matrix[$r][$c], SymbolCoordinates::SYMBOLS)) {
                    $results[] = new SymbolCoordinates($r, $c, $matrix[$r][$c], true);
                }

                if ($carry !== "") {
                    $numberColumn = $c - strlen($carry);
                    $numberRow = $numberColumn < 0 ? $r - 1 : $r;
                    $numberColumn = $numberColumn < 0 ? count($matrix[$r - 1]) + $numberColumn : $numberColumn;
                    $results[] = new SymbolCoordinates($numberRow, $numberColumn, $carry, false);
                    $carry = "";
                }
            }
        }
        return array_map(fn(SymbolCoordinates $item) => $item->getGearRatio($results), $results);
    }
}