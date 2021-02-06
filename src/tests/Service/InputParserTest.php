<?php
namespace Tests\Service;

use Dmitrev\RobotChallenge\Service\InputParser;
use Tests\TestCase;

class InputParserTest extends TestCase
{
    public function testCanParseBasicSampleInput()
    {
        $input = <<<EOL
        5 3
        1 1 E
        RFRFRFRF
        3 2 N
        FRRFLLFFRRFLL
        0 3 W
        LLFFFLFLFL
        EOL;

        $expected = [
            'farm' => ['maxX' => 5, 'maxY' => 3],
            'robots' => [
                [
                    'x' => 1,
                    'y' => 1,
                    'orientation' => 'E',
                    'moves' => ['R','F','R','F','R','F','R','F']
                ],
                [
                    'x' => 3,
                    'y' => 2,
                    'orientation' => 'N',
                    'moves' => ['F','R','R','F','L','L','F','F','R','R','F','L','L']
                ],
                [
                    'x' => 0,
                    'y' => 3,
                    'orientation' => 'W',
                    'moves' => ['L','L','F','F','F','L','F','L','F','L']
                ]
            ]
        ];

        $this->assertEquals($expected, InputParser::parse($input));

    }
}
