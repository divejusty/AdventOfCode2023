<?php

namespace AoC2023\Lib\Contracts;

interface Runnable
{
    public function run(): void;
    public function execute(): void;
}