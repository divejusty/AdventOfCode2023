<?php

function registerRoutes(\AoC2023\Lib\Kernel $kernel): void
{
    $kernel->register('1/1', \AoC2023\Tasks\Day1\Day1Part1::class);
    $kernel->register('1/2', \AoC2023\Tasks\Day1\Day1Part2::class);
}