<?php

namespace AOC2023\Tasks\Day3;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\SymbolCoordinates;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day3Part1 extends BaseTask
{
    public function run(): void
    {
        // Training 1: 4361
        $inputFile = File::inputFile('Day3/training1.txt');

        // input: 498559
        $inputFile = File::inputFile('Day3/input.txt');

        $inputMatrix = File::readAsMatrix($inputFile);

        $numbers = $this->parseSymbols($inputMatrix);

        $result = array_reduce($numbers, fn(int $carry, SymbolCoordinates $item) => $carry + $item->value(), 0);

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
        return array_filter($results, fn(SymbolCoordinates $item) => $item->hasAdjacent($results) && !$item->isSymbol);
    }
}