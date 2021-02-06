<?php

namespace Tests\Object;

use Dmitrev\RobotChallenge\Object\Farm;
use Tests\TestCase;

class FarmTest extends TestCase
{
    /**
     * @dataProvider offEdgeProvider
     * @param array $dimensions
     * @param array $coords
     * @param bool $offEdge
     */
    public function testOffEdge(array $dimensions, array $coords, bool $offEdge)
    {
        [$width, $height] = $dimensions;
        $farm = new Farm($width, $height);

        [$x, $y] = $coords;

        $this->assertEquals($offEdge, $farm->offEdge($x, $y));
    }

    public function offEdgeProvider(): array
    {
        return [
            [[2, 2], [2, 3], true],
            [[2, 2], [3, 2], true],
            [[2, 2], [2, 2], false],
            [[2, 2], [0, 0], false],
            [[2, 2], [-1, 0], true],
        ];
    }

    /**
     * @dataProvider scentProvider
     * @param array $sprayAt
     * @param array $checkAt
     * @param bool $expected
     */
    public function testScent(array $sprayAt, array $checkAt, bool $expected)
    {
        $farm = new Farm(1, 1);
        [$sprayX, $sprayY] = $sprayAt;
        $farm->sprayScent($sprayX, $sprayY);

        [$checkX, $checkY] = $checkAt;
        $this->assertEquals($expected, $farm->hasScent($checkX, $checkY));
    }

    public function scentProvider()
    {
        return [
            [[1, 1], [1, 1], true],
            [[0, 0], [0, 0], true],
            [[1, 0], [1, 0], true],
            [[0, 1], [0, 1], true],
            [[0, 0], [1, 1], false],
            [[1, 1], [0, 0], false],
            [[1, 0], [0, 1], false],
        ];
    }
}
