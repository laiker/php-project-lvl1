<?php

namespace BrainGames\Games\CalcGame;

function run()
{
    $fnGameExpression = function () {
        $mathSymbol = ['+', '-', '*'];
        return \rand(1, 100) . $mathSymbol[rand(0, 2)] . \rand(1, 100);
    };

    $fnGameCalculation = function ($lastUserExpression) {
        return eval('return ' . $lastUserExpression . ';');
    };
    
    $gameRule = "What is the result of the expression?";
    
    \BrainGames\Engine\run($fnGameExpression, $fnGameCalculation, $gameRule);
}
