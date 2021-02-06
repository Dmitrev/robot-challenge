<?php
require_once __DIR__.'/../vendor/autoload.php';

use Dmitrev\RobotChallenge\Controller\Controller;

echo (new Controller())->handle();
