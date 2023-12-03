<?php

function registerRoutes(\AoC2023\Lib\Kernel $kernel): void
{
    $kernel->register('1/1', \AoC2023\Tasks\Day1\Day1Part1::class);
    $kernel->register('1/2', \AoC2023\Tasks\Day1\Day1Part2::class);

    $kernel->register('2/1', \AoC2023\Tasks\Day2\Day2Part1::class);
    $kernel->register('2/2', \AoC2023\Tasks\Day2\Day2Part2::class);

    $kernel->register('3/1', \AoC2023\Tasks\Day3\Day3Part1::class);
    $kernel->register('3/2', \AoC2023\Tasks\Day3\Day3Part2::class);
}