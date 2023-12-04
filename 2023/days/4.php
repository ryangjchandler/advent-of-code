<?php

namespace Day4;

function part1(string $input): int
{
    $lines = explode(PHP_EOL, $input);
    $total = 0;

    foreach ($lines as $line) {
        [$left, $right] = explode(' | ', $line);
        [$winners, $numbers] = [
            array_filter(array_map(trim(...), explode(' ', explode(': ', $left)[1]))),
            array_filter(array_map(trim(...), explode(' ', $right)))
        ];

        $matches = [];

        foreach ($numbers as $number) {
            if (in_array($number, $winners)) {
                $matches[] = $number;
            }
        }

        if (count($matches) === 0) {
            continue;
        }

        $total += 1 * (2 ** (count($matches) - 1));
    }

    return $total;
}

check('Day 4 Part 1 Example', '2023/inputs/day-4-example.txt', part1(...), 13);
produce('Day 4 Part 1', '2023/inputs/day-4.txt', part1(...));

function part2(string $input): int
{
    $lines = explode(PHP_EOL, $input);
    $total = count($lines);

    for ($i = 0; $i <= count($lines); $i++) {
        dump($i);
        $total += check_copies($lines, $i);
    }

    return $total;
}

function check_copies(array $cards, int $index): int
{
    if ($index >= count($cards)) {
        return 0;
    }

    $line = $cards[$index];
    $total = 0;

    [$left, $right] = explode(' | ', $line);
    [$winners, $numbers] = [
        array_filter(array_map(trim(...), explode(' ', explode(': ', $left)[1]))),
        array_filter(array_map(trim(...), explode(' ', $right)))
    ];

    $matches = 0;

    foreach ($numbers as $number) {
        if (in_array($number, $winners)) {
            $matches++;
        }
    }

    if ($matches === 0) {
        return $total;
    }

    for ($i = 1; $i <= $matches; $i++) {
        $total += 1 + check_copies($cards, $index + $i);
    }

    return $total;
}

check('Day 4 Part 2 Example', '2023/inputs/day-4-example.txt', part2(...), 30);
produce('Day 4 Part 2', '2023/inputs/day-4.txt', part2(...));