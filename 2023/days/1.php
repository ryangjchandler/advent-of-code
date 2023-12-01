<?php

namespace Day1;

function part1(string $input): int
{
    $lines = explode(PHP_EOL, $input);
    $total = 0;

    foreach ($lines as $line) {
        $characters = str_split($line);
        $numericCharacters = array_values(array_filter($characters, fn (string $character) => is_numeric($character)));

        $firstNumber = $numericCharacters[0];
        $lastNumber = $numericCharacters[count($numericCharacters) - 1];
        $result = "{$firstNumber}{$lastNumber}";

        $total += $result;
    }

    return $total;
}

check('Day 1 Part 1 Example', '2023/inputs/day-1-part-1-example.txt', part1(...), 142);
produce('Day 1 Part 1', '2023/inputs/day-1.txt', part1(...));

function part2(string $input): int
{
    $lines = explode(PHP_EOL, $input);
    $total = 0;
    $words = [
        'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
    ];

    foreach ($lines as $line) {
        $characters = str_split($line);
        $newLine = '';

        foreach ($characters as $character) {
            $newLine .= $character;

            foreach ($words as $index => $word) {
                $newLine = str_replace($word, $index + 1 . $character, $newLine);
            }
        }

        $characters = str_split($newLine);
        $numericCharacters = array_values(array_filter($characters, fn (string $character) => is_numeric($character)));

        $firstNumber = $numericCharacters[0];
        $lastNumber = $numericCharacters[count($numericCharacters) - 1];
        $result = "{$firstNumber}{$lastNumber}";

        $total += (int) $result;
    }

    return $total;
}

check('Day 1 Part 2 Example', '2023/inputs/day-1-part-2-example.txt', part2(...), 281);
produce('Day 1 Part 2', '2023/inputs/day-1.txt', part2(...));