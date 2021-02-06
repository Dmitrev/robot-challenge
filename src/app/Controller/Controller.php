<?php
namespace Dmitrev\RobotChallenge\Controller;

use Dmitrev\RobotChallenge\Object\Farm;
use Dmitrev\RobotChallenge\Object\Robot;
use Dmitrev\RobotChallenge\Service\InputGenerator;
use Dmitrev\RobotChallenge\Service\InputParser;
use Stringable;

class Controller
{
    public function handle(): string|Stringable
    {

        $input = InputGenerator::random();
        // Override input with sample data
//        $input = InputGenerator::example();

        $parsedInput = InputParser::parse($input);

        $farm = new Farm(
            maxX: $parsedInput['farm']['maxX'],
            maxY: $parsedInput['farm']['maxY']
        );

        $response = "<h1>Received input:</h1>";
        $response .= "<pre>{$input}</pre>";

        $response .= "<h1>Received output:</h1>";

        $output = '';
        foreach ($parsedInput['robots'] as $robotData) {
            $robot = new Robot(
                farm: $farm,
                x: $robotData['x'],
                y: $robotData['y'],
                orientation: $robotData['orientation'],
                moves: $robotData['moves'],
            );

            $robot->deploy();
            $output .= $robot->getPosition()."<br />";
        }

        $response.= "<pre>{$output}</pre>";

        return $response;
    }
}
