<?php

namespace Dmitrev\RobotChallenge\Object;

use RuntimeException;

class Robot
{
    private array $orientations = ['N', 'E', 'S', 'W',];
    private int $currentOrientation;

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
                default: throw new RuntimeException("Undefined move: '{$move}'");
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

}
