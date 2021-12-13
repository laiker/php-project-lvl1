<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Cli\run as makeGreetings;

function makeQuestion(\Closure $fnGameExpression)
{
    $userResults = [];
    $gameExpression = \call_user_func($fnGameExpression);
    line("Question: " . $gameExpression);
    $userAnswer = prompt('Your answer');
    $userResults[] = ['question' => $gameExpression, 'answer' => $userAnswer];
    return $userResults;
}

function makeAnswer(\Closure $fnGameCalculation, array $userResults, string $name)
{
    $lastUserExpression = array_key_last($userResults);
    $userLastResult = $userResults[$lastUserExpression];
    $gameResultCorrectAnswer = \call_user_func($fnGameCalculation, $userLastResult['question']);

    if ($gameResultCorrectAnswer != $userLastResult['answer']) {
        $partOne = "'" . $userLastResult['answer'] . "' is wrong answer ;(";
        $partTwo = " Correct answer was '" . $gameResultCorrectAnswer . "'";
        line($partOne . $partTwo);
        line("Let's try again, " . $name . "!");
        return false;
    }

    line("Correct!");
    return true;
}

function run(\Closure $fnGameExpression, \Closure $fnGameCalculation, string $gameRule)
{
    $name = makeGreetings($gameRule);
    for ($i = 0; $i < 3; $i++) {
        $userResults = makeQuestion($fnGameExpression);
        if (!makeAnswer($fnGameCalculation, $userResults, $name)) {
            return false;
        }
    }

    line("Congratulations, " . $name . "!");
}
