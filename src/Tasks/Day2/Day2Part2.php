<?php

namespace AOC2023\Tasks\Day2;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\CubeBag;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day2Part2 extends BaseTask
{
    public static string $name = "Day 2 Part 2";

    public function run(): void
    {
        // Training 1: 2286
        $inputFile = File::inputFile('Day2/training1.txt');

        // input: 2685
        $inputFile = File::inputFile('Day2/input.txt');

        $input = File::read($inputFile);
        $games = CubeBag::parse($input);

        $powerSetSum = array_reduce($games, function (int $carry, CubeBag $bag) {
            return $carry + $this->powerSet($bag);
        }, 0);

        IO::write("$powerSetSum");

    }

    private function powerSet(CubeBag $game): int
    {
        $colours = [
            'red' => $game->maxOfColour('red'),
            'green' => $game->maxOfColour('green'),
            'blue' => $game->maxOfColour('blue'),
        ];
        $colourNumbers = array_map(fn($item) => $item === 0 ? 1 : $item, $colours);
        return array_product($colourNumbers);
    }
}