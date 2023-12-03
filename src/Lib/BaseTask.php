<?php

namespace AoC2023\Lib;

abstract class BaseTask implements Contracts\Runnable
{
    public static string $name;

    public function execute(): void
    {
        IO::write("Running task " . static::$name);
        $this->run();
    }
}