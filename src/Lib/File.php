<?php

namespace AoC2023\Lib;

final class File
{
    public static function mapOverFile($fileName, $callback): void
    {
        $file = fopen($fileName, 'r');
        while($line = fgets($file)) {
            $callback($line);
        }
        fclose($file);
    }

    public static function read($fileName): string
    {
        return file_get_contents($fileName);
    }

    public static function inputFile($fileName): string
    {
        return __DIR__ . '/../../Input/' . $fileName;
    }
}