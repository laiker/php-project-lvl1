<?php

namespace BrainGames\Games\ProgressionGame;

function run()
{
    $fnGameExpression = function () {
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

        $arProgression[rand(0, $countProgression - 1)] = '...';

        return implode(' ', $arProgression);
    };

    $fnGameCalculation = function ($lastUserExpression) {
        $arProgression = explode(' ', $lastUserExpression);
        $progressionCount = count($arProgression);
        foreach ($arProgression as $key => $digit) {
            if ($digit == '...') {
                if ($key > 0 && $key < $progressionCount - 1) {
                    return ($arProgression[$key + 1] + $arProgression[$key - 1])  / 2;
                } elseif ($key == 0) {
                    return $arProgression[$key + 1] - ($arProgression[$key + 2] - $arProgression[$key + 1]);
                } else {
                    return ($arProgression[$key - 1] - $arProgression[$key - 2]) + $arProgression[$key - 1];
                }
            }
        }
    };

    $gameRule = "What number is missing in the progression?";
    \BrainGames\Engine\run($fnGameExpression, $fnGameCalculation, $gameRule);
}
