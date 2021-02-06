<?php

namespace Dmitrev\RobotChallenge\Object;


class Farm
{
    protected array $scents = [];

    public function __construct(
        private int $maxX,
        private int $maxY
    ) {}

    public function offEdge(int $x, int $y): bool
    {
        return $x < 0 || $y < 0 || $x > $this->maxX || $y > $this->maxY;
    }

    public function sprayScent(int $x, int $y)
    {
        $this->scents[] = [$x, $y];
    }

    public function hasScent($x, $y): bool
    {
        return array_search([$x, $y], $this->scents) !== false;
    }
}
