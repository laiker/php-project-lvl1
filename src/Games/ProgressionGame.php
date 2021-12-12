<?php

namespace BrainGames\Games\ProgressionGame;

use BrainGames\Engine;

function run()
{
    $fnGameExpression = function() {
        $arProgression = [];
        $startStep = \rand(1, 100);
        $progressionStep = \rand(1, 20);
        $countProgression = \rand(5, 10);
        for ($i = 0; $i < $countProgression; $i++) {
            if ($i == 0) { 
                $arProgression[$i] = $startStep;
            } else {
                $arProgression[$i] = $arProgression[$i - 1] + $progressionStep;
            }
        }

        $arProgression[rand(1, $countProgression - 2)] = '...';

        return implode(' ', $arProgression);
    };

    $fnGameCalculation = function($lastUserExpression) {
        $arProgression = explode(' ', $lastUserExpression);
        foreach ($arProgression as $key => $digit) {
            if ($digit == '...') {
                return ($arProgression[$key + 1] + $arProgression[$key - 1])  / 2;
            }
        }
    };

    $gameEngine = new Engine($fnGameExpression, $fnGameCalculation, "What number is missing in the progression?");
    $gameEngine->run();
}
