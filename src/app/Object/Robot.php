<?php


namespace Dmitrev\RobotChallenge\Object;


class Robot
{
    public function __construct(
      private int $x,
      private int $y,
      private string $orientation,
      private string $moves
    ) {}
}
