<?php

namespace AOC2023\Tasks\Day4;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\ScratchCard;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day4Part1 extends BaseTask
{
    public static string $name = "Day 4 Part 1";

    public function run(): void
    {
        // Training 1: 13
        $inputFile = File::inputFile('Day4/training1.txt');

        // input: 32001
        $inputFile = File::inputFile('Day4/input.txt');

        $cards = [];

        File::mapOverFile($inputFile, function ($line) use (&$cards) {
            $cards[] = ScratchCard::parse($line);
        });

        $totalScore = array_reduce($cards, fn(int $carry, ScratchCard $card):int => $carry + $card->getScore(), 0);
        IO::write("$totalScore");
    }
}