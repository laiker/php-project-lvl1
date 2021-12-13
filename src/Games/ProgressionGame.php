<?php

namespace BrainGames\Games\ProgressionGame;

function run()
{
    $fnGameExpression = function () {
        $arProg = [];
        $startStep = \rand(1, 100);
        $progressionStep = \rand(1, 20);
        $countProgression = \rand(5, 10);
        for ($i = 0; $i < $countProgression; $i++) {
            if ($i == 0) {
                $arProg[$i] = $startStep;
            } else {
                $arProg[$i] = $arProg[$i - 1] + $progressionStep;
            }
        }

        $arProg[rand(0, $countProgression - 1)] = '..';

        return implode(' ', $arProg);
    };

    $fnGameCalculation = function ($lastUserExpression) {
        $arProg = explode(' ', $lastUserExpression);
        $progressionCount = count($arProg);
        foreach ($arProg as $key => $digit) {
            if ($digit == '..') {
                if ($key > 0 && $key < $progressionCount - 1) {
                    return (intval($arProg[$key + 1]) + intval($arProg[$key - 1]))  / 2;
                } elseif ($key == 0) {
                    return intval($arProg[$key + 1]) - (intval($arProg[$key + 2]) - intval($arProg[$key + 1]));
                } else {
                    return (intval($arProg[$key - 1]) - intval($arProg[$key - 2])) + intval($arProg[$key - 1]);
                }
            }
        }
    };

    $gameRule = "What number is missing in the progression?";
    \BrainGames\Engine\run($fnGameExpression, $fnGameCalculation, $gameRule);
}
