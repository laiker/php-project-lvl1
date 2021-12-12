<?php

namespace BrainGames\Games\PrimeGame;

function run()
{
    $fnGameExpression = function () {
        return \rand(1, 100);
    };

    $fnGameCalculation = function ($lastUserExpression, $i = 2) use (&$fnGameCalculation) {
        if ($lastUserExpression <= 2) {
            return ($lastUserExpression == 2) ? "yes" : "no";
        }

        if ($lastUserExpression % $i == 0) {
            return "no";
        }

        if ($i * $i > $lastUserExpression) {
            return "yes";
        }

        return $fnGameCalculation($lastUserExpression, $i + 1);
    };

    $gameRule = "Answer \"yes\" if the number is prime, otherwise answer \"no\".";
    \BrainGames\Engine\run($fnGameExpression, $fnGameCalculation, $gameRule);
}
