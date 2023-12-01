<?php

namespace AOC2023\Tasks\Day1;

use AoC2023\Lib\File;
use AoC2023\Lib\IO;

class Day1Part1 extends \AoC2023\Lib\BaseTask
{
    private function findFirstNumber($str) {
        for($i = 0; $i < strlen($str); $i++) {
            if(is_numeric($str[$i])) {
                return $str[$i];
            }
        }
    }

    private function findLastNumber($str) {
        for($i = strlen($str) - 1; $i >= 0; $i--) {
            if(is_numeric($str[$i])) {
                return $str[$i];
            }
        }
    }

    public function run(): void
    {
        $input = File::inputFile('Day1/input.txt'); //54601
//        $input = File::inputFile('Day1/training1.txt');

        $result = 0;

        File::mapOverFile($input, function ($line) use (&$result) {
            $result += (int) ($this->findFirstNumber($line) . $this->findLastNumber($line));
        });

        IO::write($result);
    }
}

