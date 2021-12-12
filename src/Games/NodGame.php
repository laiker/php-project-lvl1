<?php

namespace BrainGames\Games\NodGame;

use BrainGames\Engine;

function run()
{
    $fnGameExpression = function() {
        return \rand(1, 100) . ' ' . \rand(1, 100);
    };

    $fnGameCalculation = function($lastUserExpression) {
        $arNodDigits = \explode(' ', $lastUserExpression);
        while ($arNodDigits[0] != $arNodDigits[1])
        {
            if ($arNodDigits[0] > $arNodDigits[1]) $arNodDigits[0] =  $arNodDigits[0] - $arNodDigits[1];
            else $arNodDigits[1] = $arNodDigits[1] - $arNodDigits[0];
        }
        return $arNodDigits[1];
    };

    $gameEngine = new Engine($fnGameExpression, $fnGameCalculation, "Find the greatest common divisor of given numbers.");
    $gameEngine->run();
}
