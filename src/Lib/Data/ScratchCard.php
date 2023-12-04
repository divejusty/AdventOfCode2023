<?php

namespace AoC2023\Lib\Data;

final class ScratchCard
{
    private function __construct(public readonly int $id, private readonly array $numbers, private readonly array $winningNumbers)
    {
    }

    public static function parse(string $line): ScratchCard
    {
        [$identification, $allNumbers] = explode(":", $line, 2);
        $id = (int)trim(explode(" ", trim($identification), 2)[1]);
        $numberSets = explode("|", trim($allNumbers));
        $winningNumbers = array_map(fn(string $line) => (int)trim($line), explode(" ", trim($numberSets[0])));
        $winningNumbers = array_filter($winningNumbers, fn(int $item) => $item !== 0);
        $numbers = array_map(fn(string $line) => (int)trim($line), explode(" ", trim($numberSets[1])));
        $numbers = array_filter($numbers, fn(int $item) => $item !== 0);
        return new ScratchCard($id, $numbers, $winningNumbers);
    }

    public function numberOfMatches(): int
    {
        return count(array_intersect($this->numbers, $this->winningNumbers));
    }

    public function getScore(): int
    {
        return array_reduce($this->numbers, function (int $carry, int $item): int {
            if (in_array($item, $this->winningNumbers)) {
                if ($carry === 0) {
                    return 1;
                }
                return $carry * 2;
            }
            return $carry;
        }, 0);
    }
}