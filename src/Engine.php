<?php

namespace BrainGames;

use function cli\line;
use function cli\prompt;

class Engine
{
    protected $name;
    protected $userResults;

    public function __construct($fnGameExpression, $fnGameCalculation, $gameRule)
    {
        $this->fnGameExpression = $fnGameExpression;
        $this->fnGameCalculation = $fnGameCalculation;
        $this->gameRule = $gameRule;
    }

    protected function makeGreetings()
    {
        line('Welcome to the Brain Game!');
        $this->name = prompt('May I have your name?');
        line("Hello, %s!", $this->name);
        line($this->gameRule);
    }

    public function makeQuestion()
    {
        $gameExpression = \call_user_func($this->fnGameExpression);
        line("Question: " . $gameExpression);
        $userAnswer = prompt('Your answer');
        $this->userResults[] = ['question' => $gameExpression, 'answer' => $userAnswer];
    }

    protected function makeAnswer()
    {
        $lastUserExpression = array_key_last($this->userResults);
        $userLastResult = $this->userResults[$lastUserExpression];
        $gameResultCorrectAnswer = \call_user_func($this->fnGameCalculation, $userLastResult['question']);

        if ($gameResultCorrectAnswer != $userLastResult['answer']) {
            line("'" . $userLastResult['answer'] . "' is wrong answer ;(. Correct answer was '" . $gameResultCorrectAnswer . "'.\n Let's try again, " . $this->name . "!");
            die();
            return false;
        }

        line("Correct!");
        return true;
    }

    public function run()
    {
        $this->makeGreetings();
        $gameSuccess = true;
        for ($i = 0; $i < 3; $i++) {
            $this->makeQuestion();
            if (!$this->makeAnswer()) {
                return false;
            }
        }
        if ($gameSuccess) {
            line("Congratulations, " . $this->name . "!");
        }
    }
}
