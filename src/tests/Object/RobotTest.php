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

    /**
     * @dataProvider forwardMovesProvider
     * @param string $orientation
     * @param array $moves
     * @param int $expectedX
     * @param int $expectedY
     */
    public function testCanMoveForward(string $orientation, array $moves, int $expectedX, int $expectedY)
    {
        $robot = new Robot(
            farm: new Farm(2, 2),
            x: 1,
            y: 1,
            orientation: $orientation,
            moves: $moves
        );

        $robot->deploy();

        $this->assertEquals($expectedX, $robot->getX());
        $this->assertEquals($expectedY, $robot->getY());
    }

    public function forwardMovesProvider(): array
    {
        return [
            ['orientation' => 'N', 'moves' => ['F'], 'expectedX' => 1, 'expectedY' => 2],
            ['orientation' => 'E', 'moves' => ['F'], 'expectedX' => 2, 'expectedY' => 1],
            ['orientation' => 'S', 'moves' => ['F'], 'expectedX' => 1, 'expectedY' => 0],
            ['orientation' => 'W', 'moves' => ['F'], 'expectedX' => 0, 'expectedY' => 1],
        ];
    }

    public function testStopsMovingWhenDestroyed()
    {
        $farm = new Farm(1, 1);
        $robot = new Robot(
            farm: $farm,
            x: 0,
            y: 0,
            orientation: 'W',
            moves: ['R', 'F', 'F', 'F']
        );

        $robot->deploy();

        $this->assertEquals(true, $robot->isDestroyed());
        $this->assertEquals(0, $robot->getX());
        $this->assertEquals(1, $robot->getY());
    }

    public function testDontGetOffEdgeFromSameCoordsAsOtherRobot()
    {
        $farm = new Farm(1, 1);
        $dumbRobot = new Robot(farm: $farm, x: 0, y: 0, orientation: 'W', moves: ['R', 'F', 'F', 'F']);
        $smartRobot = new Robot(farm: $farm, x: 0, y: 0, orientation: 'W', moves: ['R', 'F', 'F', 'F']);

        $dumbRobot->deploy();
        $smartRobot->deploy();

        $this->assertEquals(false, $smartRobot->isDestroyed());
    }
}
