<?php

namespace BrainGames\Games\GcdGame;

function run()
{
    $fnGameExpression = function () {
        return \rand(1, 100) . ' ' . \rand(1, 100);
    };

    $fnGameCalculation = function ($lastUserExpression) {
        $arNodDigits = \explode(' ', $lastUserExpression);
        while ($arNodDigits[0] != $arNodDigits[1]) {
            if ($arNodDigits[0] > $arNodDigits[1]) {
                $arNodDigits[0] =  $arNodDigits[0] - $arNodDigits[1];
            } else {
                $arNodDigits[1] = $arNodDigits[1] - $arNodDigits[0];
            }
        }
        return $arNodDigits[1];
    };

    $gameRule = "Answer \"yes\" if the number is even, otherwise answer \"no\".";

    \BrainGames\Engine\run($fnGameExpression, $fnGameCalculation, $gameRule);
}
