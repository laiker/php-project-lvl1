<?php

namespace BrainGames\Games\EvenGame;

function run()
{
    $fnGameExpression = function () {
        return \rand(1, 100);
    };

    $fnGameCalculation = function ($lastUserExpression) {
        return ($lastUserExpression % 2 == 0) ? 'yes' : 'no';
    };

    $gameRule = "Answer \"yes\" if the number is even, otherwise answer \"no\".";

    \BrainGames\Engine\run($fnGameExpression, $fnGameCalculation, $gameRule);
}
