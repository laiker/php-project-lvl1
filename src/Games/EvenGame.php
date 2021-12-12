<?php

namespace BrainGames\Games\EvenGame;

use BrainGames\Engine;

function run()
{
    $fnGameExpression = function() {
        return \rand(1, 100);
    };

    $fnGameCalculation = function($lastUserExpression) {
        return ($lastUserExpression % 2 == 0) ? 'yes' : 'no';
    };

    $gameEngine = new Engine($fnGameExpression, $fnGameCalculation, "Answer \"yes\" if the number is even, otherwise answer \"no\".");
    $gameEngine->run();
}