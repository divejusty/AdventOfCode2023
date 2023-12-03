<?php

namespace AOC2023\Tasks\Day2;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\CubeBag;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day2Part1 extends BaseTask
{
    public static string $name = "Day 2 Part 1";

    public function run(): void
    {
        // Training 1: 8
        $inputFile = File::inputFile('Day2/training1.txt');
        $maxNumbers = [
            'red' => 12,
            'green' => 13,
            'blue' => 14,
        ];

        // input: 2685
        $inputFile = File::inputFile('Day2/input.txt');

        $input = File::read($inputFile);
        $games = CubeBag::parse($input);

        $gamesPossibleIdSum = array_reduce($games, function (int $carry, CubeBag $bag) use ($maxNumbers) {
            if ($bag->maxOfColour('red') <= $maxNumbers['red']
                && $bag->maxOfColour('green') <= $maxNumbers['green']
                && $bag->maxOfColour('blue') <= $maxNumbers['blue']
            ) {
                return $carry + $bag->id;
            }

            return $carry;
        }, 0);

        IO::write("$gamesPossibleIdSum");

    }
}