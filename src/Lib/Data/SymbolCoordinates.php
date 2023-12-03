<?php

namespace AoC2023\Lib\Data;

final class SymbolCoordinates
{
    public const SYMBOLS = [
        '%',
        '#',
        '*',
        '$',
        '/',
        '-',
        '&',
        '+',
        '@',
        '=',
    ];
    private int $symbolLength;
    private array $rowRange;
    private array $columnRange;

    public function __construct(public readonly int $row, public readonly int $column, public readonly string $symbol, public readonly bool $isSymbol)
    {
        $this->symbolLength = strlen($symbol);
        $this->rowRange = range($this->row - 1, $this->row + 1);
        $this->columnRange = range($this->column - 1, $this->column + $this->symbolLength);
    }

    public function toString(): string
    {
        return "$this->symbol ($this->row, $this->column)";
    }

    public function value(): int
    {
        return $this->isSymbol ? 0 : (int)$this->symbol;
    }

    public function hasAdjacent(array $symbols): bool
    {
        foreach ($symbols as $symbol) {
            if (in_array($symbol->row, $this->rowRange) && in_array($symbol->column, $this->columnRange) && $symbol->symbol !== $this->symbol && $symbol->isSymbol) {
                return true;
            }
        }
        return false;
    }

    public function getGearRatio(array $symbols): int
    {
        if ($this->symbol !== '*') {
            return 0;
        }

        $adjacentNumbers = [];
        foreach ($symbols as $symbol) {
            if ($symbol->isSymbol) {
                continue;
            }
            if ($symbol->hasAdjacent([$this])) {
                $adjacentNumbers[] = $symbol;
            }
        }

        if (count($adjacentNumbers) !== 2) {
            return 0;
        }

        return array_reduce($adjacentNumbers, fn(int $carry, SymbolCoordinates $item) => $carry * $item->value(), 1);
    }
}