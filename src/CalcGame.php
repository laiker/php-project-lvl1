<?php

namespace BrainGames\CalcGame;

use BrainGames\Engine;

function run()
{
    $fnGameExpression = function() {
        $mathSymbol = ['+', '-', '*'];
        return \rand(1, 100) . $mathSymbol[rand(0, 2)] . \rand(1, 100);
    };

    $fnGameCalculation = function($lastUserExpression) {
        return eval('return ' . $lastUserExpression . ';');
    };

    $gameEngine = new Engine($fnGameExpression, $fnGameCalculation, "What is the result of the expression?");
    $gameEngine->run();
}