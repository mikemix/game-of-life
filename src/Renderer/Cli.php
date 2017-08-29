<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Game\GenerationContext;

final class Cli implements Renderer
{
    const BORDER_SYMBOL = '░';
    const CELL_SYMBOL = '⯃';

    public function render(GenerationContext $context)
    {
        $cells = $context->getCells();
        $maxWidth = array_reduce($cells, function($max, $current) {
            return $max > count($current) ? $max : count($current);
        }, 0);

        printf("Generation %d / %d\n", $context->getGeneration(), $context->getIterationCount());
        printf(" %s\n", str_repeat(self::BORDER_SYMBOL, $maxWidth));

        $isDead = true;
        foreach ($cells as $x => $cellY) {
            echo self::BORDER_SYMBOL;
            foreach ($cellY as $y => $cellX) {
                if ($cells[$x][$y] > 0) {
                    $isDead = false;
                    echo self::CELL_SYMBOL;
                } else {
                    echo ' ';
                }
            }

            echo str_repeat(' ', ($maxWidth-count($cellY)));
            echo self::BORDER_SYMBOL, PHP_EOL;
        }

        printf(" %s\n", str_repeat(self::BORDER_SYMBOL, $maxWidth));

        if ($isDead) {
            die(sprintf("Universe is dead at generation %d\n", $context->getGeneration()));
        }
    }
}
