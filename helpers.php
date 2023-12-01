<?php

function check(string $name, string $input, Closure $callback, mixed $expected)
{
    $result = run($input, $callback);

    if ($result === $expected) {
        echo "\033[32m✔\033[0m {$name}\n";
    } else {
        echo "\033[31m✘\033[0m {$name} - expected {$expected}, got {$result}\n";
    }
}

function run(string $input, Closure $callback): mixed
{
    $input = file_get_contents($input);

    return $callback($input);
}

function produce(string $name, string $input, Closure $callback): void
{
    $result = run($input, $callback);

    echo "{$name} produced the answer {$result}.\n";
}

function base_path(string $path = ''): string
{
    return __DIR__ . ($path ? ('/'.$path) : $path);
}