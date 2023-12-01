<?php

namespace AoC2023\Lib;

final class Kernel
{
    private array $routes = [];

    private function runAssignment(string $task = null): void
    {
        if (is_null($task)) {
            IO::write('Please enter what task you want to run');
            $task = IO::read();
        }

        if (!isset($this->routes[$task])) {
            IO::write('Unknown task, please try again');
            return;
        }

        (new $this->routes[$task]())->run();
    }

    public function register(string $route, string $action): void
    {
        $this->routes[$route] = $action;
    }

    private function list(): void
    {
        IO::write('Available tasks:');
        foreach ($this->routes as $route => $action) {
            IO::write($route);
        }
    }

    public function run(): void
    {
        $running = true;
        while ($running) {
            IO::write('Welcome to the Advent of Code 2023, please enter a command (list, exit)');
            $command = IO::read();
            switch ($command) {
                case 'exit':
                case 'quit':
                case 'q':
                case ':q':
                    $running = false;
                    break;
                case 'list':
                    $this->list();
                    break;
                case 'run':
                    $this->runAssignment();
                    break;
                default:
                    self::runAssignment($command);
            }
        }
    }
}
