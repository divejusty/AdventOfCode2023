<?php

namespace AoC2023\Lib;

final class File
{
    public static function mapOverFile($fileName, $callback): void
    {
        $file = fopen($fileName, 'r');
        while ($line = fgets($file)) {
            $callback($line);
        }
        fclose($file);
    }

    public static function read($fileName): string
    {
        return file_get_contents($fileName);
    }

    public static function readAsMatrix($fileName): array
    {
        $output = [];
        File::mapOverFile($fileName, function ($line) use (&$output) {
            $output[] = str_split(trim($line));
        });

        return $output;
    }

    public static function characterCounts($fileName): array
    {
        $output = [];
        File::mapOverFile($fileName, function ($line) use (&$output) {
            foreach (str_split(trim($line)) as $char) {
                if (!isset($output[$char])) {
                    $output[$char] = 0;
                }
                $output[$char]++;
            }
        });

        return $output;
    }

    public static function inputFile($fileName): string
    {
        return __DIR__ . '/../../Input/' . $fileName;
    }
}