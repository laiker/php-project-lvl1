<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

global $userResults;
global $name;

function makeGreetings($gameRule)
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line($gameRule);
    return $name;
}

function makeQuestion($fnGameExpression)
{
    $gameExpression = \call_user_func($fnGameExpression);
    line("Question: " . $gameExpression);
    $userAnswer = prompt('Your answer');
    $userResults[] = ['question' => $gameExpression, 'answer' => $userAnswer];
    return $userResults;
}

function makeAnswer($fnGameCalculation, $userResults, $name)
{
    $lastUserExpression = array_key_last($userResults);
    $userLastResult = $userResults[$lastUserExpression];
    $gameResultCorrectAnswer = \call_user_func($fnGameCalculation, $userLastResult['question']);

    if ($gameResultCorrectAnswer != $userLastResult['answer']) {
        line("'" . $userLastResult['answer'] . "' is wrong answer ;(. Correct answer was '" . $gameResultCorrectAnswer . "'");
        line("Let's try again, " . $name . "!");
        die();
        return false;
    }

    line("Correct!");
    return true;
}

function run($fnGameExpression, $fnGameCalculation, $gameRule)
{
    $name = makeGreetings($gameRule);
    $gameSuccess = true;
    for ($i = 0; $i < 3; $i++) {
        $userResults = makeQuestion($fnGameExpression);
        if (!makeAnswer($fnGameCalculation, $userResults, $name)) {
            return false;
        }
    }
    if ($gameSuccess) {
        line("Congratulations, " . $name . "!");
    }
}
