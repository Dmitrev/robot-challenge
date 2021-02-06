<?php

namespace Dmitrev\RobotChallenge\Service;

class InputParser
{
    public static function parse(string $input): array
    {
        $lines = explode("\n", $input);

        $data = [
            'farm' => [],
            'robots' => []
        ];

        // Parse first line which is always the farm
        $farmData = array_shift($lines);
        $farmData = explode(' ', $farmData);

        $data['farm'] = [
            'maxX' => (int) $farmData[0],
            'maxY' => (int) $farmData[1]
        ];

        $robots = array_chunk($lines, 2);

        foreach ($robots as $robotLines) {
            $robotPosition = explode(' ', $robotLines[0]);

            $data['robots'][] =  [
                'x' => (int)$robotPosition[0],
                'y' => (int)$robotPosition[1],
                'orientation' => $robotPosition[2],
                'moves' => str_split($robotLines[1])
            ];
        }

        return $data;
    }
}
