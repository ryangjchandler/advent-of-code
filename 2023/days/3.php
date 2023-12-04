<?php

namespace Day3;

function part1(string $input): int
{
    $rows = explode(PHP_EOL, $input);
    $total = 0;

    foreach ($rows as $r => $row) {
        preg_match_all('/(\d+)/', $row, $matches, PREG_OFFSET_CAPTURE);

        // No numbers found on row.
        if (! isset($matches[1])) {
            continue;
        }

        foreach ($matches[1] as [$number, $offset]) {
            if (adjacent_to_symbol($rows, $r, $offset, $offset + strlen($number) - 1)) {
                $total += (int) $number;
            }
        }
    }

    return $total;
}

check('Day 3 Part 1 Example', '2023/inputs/day-3-example.txt', part1(...), 4361);
produce('Day 3 Part 1', '2023/inputs/day-3.txt', part1(...));

function part2(string $input): int
{
    $rows = explode(PHP_EOL, $input);
    $total = 0;
    $gears = [];

    foreach ($rows as $r => $row) {
        preg_match_all('/(\d+)/', $row, $matches, PREG_OFFSET_CAPTURE);

        // No numbers found on row.
        if (!isset($matches[1])) {
            continue;
        }

        foreach ($matches[1] as [$number, $offset]) {
            if ($position = adjacent_to_gear($rows, $r, $offset, $offset + strlen($number) - 1)) {
                $gears[$position[0]][$position[1]][] = (int) $number;
            }
        }
    }

    foreach ($gears as $gearRow) {
        foreach ($gearRow as $gearColumn) {
            if (count($gearColumn) === 2) {
                $total += ($gearColumn[0] * $gearColumn[1]);
            }
        }
    }

    return $total;
}

check('Day 3 Part 2 Example', '2023/inputs/day-3-example.txt', part2(...), 467835);
produce('Day 3 Part 2', '2023/inputs/day-3.txt', part2(...));

function adjacent_to_symbol(array $rows, int $row, int $cs, int $ce): bool
{
    $translations = [
        [-1, -1], [-1, 0], [-1, 1],
        [0, -1], [0, 1],
        [1, -1], [1, 0], [1, 1]
    ];

    for ($col = $cs; $col <= $ce; $col++) {
        foreach ($translations as [$dr, $dc]) {
            $nr = $row + $dr;
            $nc = $col + $dc;

            if ($nr >= 0 && $nr < count($rows) && $nc >= 0 && $nc < strlen($rows[$nr])) {
                $char = $rows[$nr][$nc];

                if (! is_numeric($char) && $char !== '.') {
                    return true;
                }
            }
        }
    }

    return false;
}

function adjacent_to_gear(array $rows, int $row, int $cs, int $ce): array|false
{
    $translations = [
        [-1, -1], [-1, 0], [-1, 1],
        [0, -1], [0, 1],
        [1, -1], [1, 0], [1, 1]
    ];

    for ($col = $cs; $col <= $ce; $col++) {
        foreach ($translations as [$dr, $dc]) {
            $nr = $row + $dr;
            $nc = $col + $dc;

            if ($nr >= 0 && $nr < count($rows) && $nc >= 0 && $nc < strlen($rows[$nr])) {
                $char = $rows[$nr][$nc];

                if ($char === '*') {
                    return [$nr, $nc];
                }
            }
        }
    }

    return false;
}