<?php
namespace Tests\Object;

use Dmitrev\RobotChallenge\Object\Farm;
use Dmitrev\RobotChallenge\Object\Robot;
use Tests\TestCase;

class RobotTest extends TestCase
{

    /**
     * @dataProvider leftTurnsProvider
     * @param string $orientation
     * @param array $moves
     * @param string $expected
     */
    public function testCanTurnLeft(string $orientation, array $moves, string $expected)
    {
        $robot = new Robot(
            farm: new Farm(1, 1),
            x: 0,
            y: 0,
            orientation: $orientation,
            moves: $moves
        );

        $robot->deploy();

        $this->assertEquals($expected, $robot->getOrientation());
    }

    public function leftTurnsProvider(): array
    {
        return [
            ['orientation' => 'N', 'moves' => ['L'], 'expected' => 'W'],
            ['orientation' => 'W', 'moves' => ['L'], 'expected' => 'S'],
            ['orientation' => 'S', 'moves' => ['L'], 'expected' => 'E'],
            ['orientation' => 'E', 'moves' => ['L'], 'expected' => 'N'],
        ];
    }

    /**
     * @dataProvider rightTurnsProvider
     * @param string $orientation
     * @param array $moves
     * @param string $expected
     */
    public function testCanTurnRight(string $orientation, array $moves, string $expected)
    {
        $robot = new Robot(
            farm: new Farm(1, 1),
            x: 0,
            y: 0,
            orientation: $orientation,
            moves: $moves
        );

        $robot->deploy();

        $this->assertEquals($expected, $robot->getOrientation());
    }

    public function rightTurnsProvider(): array
    {
        return [
            ['orientation' => 'N', 'moves' => ['R'], 'expected' => 'E'],
            ['orientation' => 'E', 'moves' => ['R'], 'expected' => 'S'],
            ['orientation' => 'S', 'moves' => ['R'], 'expected' => 'W'],
            ['orientation' => 'W', 'moves' => ['R'], 'expected' => 'N'],
        ];
    }
}
