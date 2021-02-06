<?php


namespace Dmitrev\RobotChallenge\Service;


class InputGenerator
{
    public static function random(): string {

        $orientations = ['N', 'E', 'S', 'W'];
        $moves = ['L', 'R', 'F'];

        $farmWidth = mt_rand(1, 50);
        $farmHeight = mt_rand(1, 50);

        $input = "{$farmWidth} {$farmHeight}".PHP_EOL;

        $botCount = mt_rand(1, 5);

        for($i = 0; $i < $botCount; $i++) {
            $botStartX = mt_rand(0, $farmWidth - 1);
            $botStartY = mt_rand(0, $farmHeight - 1);
            $botStartOrientation = $orientations[array_rand($orientations)];

            $input.= "{$botStartX} {$botStartY} {$botStartOrientation}".PHP_EOL;
            $moveCount = mt_rand(5, 100);
            $botMoves = '';

            for ($j = 0; $j < $moveCount; $j++) {
                $botMoves.= $moves[array_rand($moves)];
            }
            $input.= $botMoves.PHP_EOL;
        }


        return $input;
    }

    // From PDF
    public static function example(): string {
        return <<<EOL
        5 3
        1 1 E
        RFRFRFRF
        3 2 N
        FRRFLLFFRRFLL
        0 3 W
        LLFFFLFLFL
        EOL;
    }
}
