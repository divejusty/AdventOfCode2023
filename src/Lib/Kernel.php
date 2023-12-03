<?php

namespace AoC2023\Lib;

final class Kernel
{
    private array $routes = [];
    private bool $running;
    private ?string $command;

    public function __construct()
    {
        $this->readOpts();
    }

    private function readOpts(): void
    {
        $opts = getopt('r::c');
        $this->running = isset($opts['c']);
        $this->command = $opts['r'] ?? null;
    }

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

        (new $this->routes[$task]())->execute();
    }

    public function register(string $route, string $action): void
    {
        $this->routes[$route] = $action;
    }

    private function list(): void
    {
        IO::write('Available tasks:');
        foreach ($this->routes as $route => $action) {
            IO::write($action::$name . ': ' . $route);
        }
    }

    private function readCommand(): string
    {
        if (!is_null($this->command)) {
            $command = $this->command;
            $this->command = null;

            return $command;
        }
        IO::write('Please enter what command you want to run');
        return IO::read();
    }

    public function run(): void
    {
        IO::write('Welcome to the Advent of Code 2023');
        do {
            $command = $this->readCommand();
            switch ($command) {
                case 'exit':
                case 'quit':
                case 'q':
                case ':q':
                    $this->running = false;
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
        } while ($this->running);
    }
}
