<?php

namespace Day2;

function part1(string $input): int
{
    $games = explode(PHP_EOL, $input);

    $maxRed = 12;
    $maxGreen = 13;
    $maxBlue = 14;
    $total = 0;

    foreach ($games as $game) {
        preg_match_all('/(\d+) red/', $game, $redMatches);
        preg_match_all('/(\d+) green/', $game, $greenMatches);
        preg_match_all('/(\d+) blue/', $game, $blueMatches);
        
        $highestReds = max($redMatches[1]);
        $highestGreens = max($greenMatches[1]);
        $highestBlues = max($blueMatches[1]);

        if ($highestReds <= $maxRed && $highestGreens <= $maxGreen && $highestBlues <= $maxBlue) {
            preg_match('/Game (\d+):/', $game, $matches);

            $total += (int) $matches[1];
        }
    }

    return $total;
}

check('Day 2 Part 1 Example', '2023/inputs/day-2-part-1-example.txt', part1(...), 8);
produce('Day 2 Part 1', '2023/inputs/day-2.txt', part1(...));

function part2(string $input): int
{
    $games = explode(PHP_EOL, $input);
    $total = 0;

    foreach ($games as $game) {
        preg_match_all('/(\d+) red/', $game, $redMatches);
        preg_match_all('/(\d+) green/', $game, $greenMatches);
        preg_match_all('/(\d+) blue/', $game, $blueMatches);

        $highestReds = max($redMatches[1]);
        $highestGreens = max($greenMatches[1]);
        $highestBlues = max($blueMatches[1]);

        $total += ($highestReds * $highestGreens * $highestBlues);
    }

    return $total;
}

check('Day 2 Part 2 Example', '2023/inputs/day-2-part-2-example.txt', part2(...), 2286);
produce('Day 2 Part 2', '2023/inputs/day-2.txt', part2(...));