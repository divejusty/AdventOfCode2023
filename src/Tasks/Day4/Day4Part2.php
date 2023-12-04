<?php

namespace AOC2023\Tasks\Day4;

use AoC2023\Lib\BaseTask;
use AoC2023\Lib\Data\ScratchCard;
use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day4Part2 extends BaseTask
{
    public static string $name = "Day 4 Part 2";

    public function run(): void
    {
        // Training 1: 30
        $inputFile = File::inputFile('Day4/training1.txt');

        // input: 5037841
        $inputFile = File::inputFile('Day4/input.txt');

        $cards = [];

        File::mapOverFile($inputFile, function ($line) use (&$cards) {
            $cards[] = ScratchCard::parse($line);
        });

        $multipliers = [];

        foreach($cards as $card) {
           $multipliers[$card->id] = 1;
        }

        array_map(function (ScratchCard $card) use (&$multipliers) {
            if ($card->numberOfMatches() === 0) {
                return;
            }
            $extraCards = range($card->id + 1, $card->id + $card->numberOfMatches());
            foreach($extraCards as $extraCard) {
                if (isset($multipliers[$extraCard])) {
                    $multipliers[$extraCard] += $multipliers[$card->id];
                }
            }
        }, $cards);

        $totalScore = array_sum($multipliers);

        IO::write("$totalScore");
    }
}