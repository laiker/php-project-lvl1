<?php

namespace BrainGames;

use function cli\line;
use function cli\prompt;
use function cli\choose;

class EvenGame
{
    protected $name;
    protected $answers;

    public function makeGreetings()
    {
        line('Welcome to the Brain Game!');
        $this->name = prompt('May I have your name?');
        line("Hello, %s!", $this->name);
        line("Answer \"yes\" if the number is even, otherwise answer \"no\".");
    }

    public function createRandomNumber()
    {
        return rand(1, 100);
    }

    public function makeQuestion()
    {
        $randomNumber = $this->createRandomNumber();
        line("Question: " . $randomNumber);
        $this->answers[$randomNumber] = prompt('Your answer');
    }

    public function makeAnswer()
    {
        $lastAnswerNumber = array_key_last($this->answers);
        $lastAnswerValue = $this->answers[$lastAnswerNumber];
        if ($lastAnswerNumber % 2 == 0 && $lastAnswerValue == 'no') {
            line("'no' is wrong answer ;(. Correct answer was 'yes'.\nLet's try again, " . $this->name . "!");
            return false;
        } 
        
        if ($lastAnswerNumber % 2 != 0 && $lastAnswerValue == 'yes') {
            line("'yes' is wrong answer ;(. Correct answer was 'no'.\nLet's try again, " . $this->name . "!");
            return false;
        }

        line("Correct!");
    }

    public function run()
    {
        $this->makeGreetings();
        for ($i = 0; $i < 3; $i++) {
            $this->makeQuestion();
            if ($this->makeAnswer()) {
                return false;
            }
        }
        line("Congratulations, " . $this->name . "!");
    }
}
