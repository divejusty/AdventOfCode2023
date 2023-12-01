<?php

namespace AoC2023\Lib\Data;

class NumberPosition
{
public function __construct(public readonly int $position, public readonly string $value)
{
}
}