<?php

namespace Dmitrev\RobotChallenge\Object;

use RuntimeException;

class Robot
{
    private array $orientations = ['N', 'E', 'S', 'W',];
    private int $currentOrientation;
    private bool $destroyed = false;

    public function __construct(
        private Farm $farm,
        private int $x,
        private int $y,
        string $orientation,
        private array $moves
    ) {
        $this->currentOrientation = array_flip($this->orientations)[$orientation];
    }


    public function deploy()
    {
        foreach ($this->moves as $move) {
            switch ($move) {
                case 'L': $this->turnLeft(); break;
                case 'R': $this->turnRight(); break;
                case 'F': $this->moveForward(); break;
                default: throw new RuntimeException("Undefined move: '{$move}'");
            }

            if ($this->isDestroyed() === true) {
                return;
            }
        }
    }

    private function turnLeft()
    {
        $newOrientation = $this->currentOrientation - 1;

        if ($newOrientation < 0) {
            $newOrientation = count($this->orientations) - 1;
        }

        $this->currentOrientation = $newOrientation;
    }

    private function turnRight()
    {
        $newOrientation = $this->currentOrientation + 1;

        if ($newOrientation > count($this->orientations) - 1){
            $newOrientation = 0;
        }

        $this->currentOrientation = $newOrientation;
    }

    public function getOrientation(): string
    {
        return $this->orientations[$this->currentOrientation];
    }

    private function moveForward()
    {
        $newX = $this->x;
        $newY = $this->y;

        switch ($this->getOrientation()) {
            case 'N': $newY++; break;
            case 'E': $newX++; break;
            case 'S': $newY--; break;
            case 'W': $newX--; break;
            default: throw new RuntimeException("Undefined orientation: '{$this->getOrientation()}'");
        }

        if ($this->farm->offEdge($newX, $newY) === false) {
            $this->x = $newX;
            $this->y = $newY;
            return;
        }

        // Other robot warned us death is ahead
        if ($this->farm->hasScent($this->x, $this->y)) {
            return;
        }

        $this->farm->sprayScent($this->x, $this->y);
        $this->destroyRobot();
    }

    private function destroyRobot()
    {
        $this->destroyed = true;
    }

    public function isDestroyed(): bool
    {
        return $this->destroyed;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getPosition(): string
    {
        $pos = "{$this->x} {$this->y} {$this->getOrientation()}";
        if ($this->isDestroyed() === true) {
            $pos .= ' LOST';
        }

        return $pos;
    }
}
