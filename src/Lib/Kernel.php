<?php

namespace AoC2023\Lib;

final class Kernel
{
    private array $routes = [];
    private bool $continuous;
    private ?string $command;

    public function __construct()
    {
        $this->readOpts();
        $this->showHeader();

    }

    private function readOpts(): void
    {
        $opts = getopt('r::ch', ['run::', 'continuous', 'help']);
        $this->continuous = isset($opts['c']) || isset($opts['continuous']);
        $this->command = $opts['r'] ?? $opts['run'] ?? null;
        if(isset($opts['h']) || isset($opts['help'])) {
            $this->command = 'list';
        }
    }

    private function showHeader(): void
    {
        IO::write('Welcome to the Advent of Code 2023');
        if($this->continuous) {
            IO::write("Programme running in continuous mode\n\n");
        }
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
        IO::write('+--- General commands: ------------------');
        IO::write('| help: display this message');
        IO::write('| exit: quit the application');
        IO::write('| run: get prompted for a task to run');
        IO::write('|      (tasks can also be ran directly)');
        IO::write('+--- Available tasks: -------------------');
        foreach ($this->routes as $route => $action) {
            IO::write('|   ' . $action::$name . ':  ' . $route);
        }
        IO::write('+----------------------------------------');
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
        do {
            $command = $this->readCommand();
            switch ($command) {
                case 'exit':
                case 'quit':
                case ':e':
                case ':q':
                    $this->continuous = false;
                    break;
                case 'list':
                case 'help':
                case ':l':
                case ':h':
                    $this->list();
                    break;
                case 'run':
                case ':r':
                    $this->runAssignment();
                    break;
                default:
                    self::runAssignment($command);
            }
        } while ($this->continuous);
    }
}
