<?php

namespace AoC2023\Lib\Data;

final class CubeBag
{
    public function __construct(public readonly int $id, private readonly array $rounds)
    {
    }

    public function maxOfColour(string $colour): int
    {
        return array_reduce($this->rounds, fn(int $carry, array $item) => max($item[$colour] ?? 0, $carry), 0);
    }

    public static function parse(string $file): array
    {
        $lines = explode("\n", $file);

        $rounds = [];

        foreach ($lines as $line) {
            $bag = self::parseLine($line);
            $rounds[] = $bag;
        }

        return $rounds;
    }

    private static function parseLine(string $line): self
    {
        [$game, $contentSets] = explode(': ', $line);
        $id = (int)trim(explode(' ', $game)[1]);

        $colours = [];
        foreach (explode(';', $contentSets) as $contentSet) {
            $colours[] = self::parseContentSet($contentSet);
        }

        return new self($id, $colours);
    }

    private static function parseContentSet(string $contentSet): array
    {
        $content = explode(',', $contentSet);
        $colours = [];
        foreach ($content as $item) {
            $result = explode(' ', trim($item));
            $colours[trim($result[1])] = (int)trim($result[0]);
        }
        return $colours;
    }

}