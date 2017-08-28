<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Game\GenerationContext;

final class Cli implements Renderer
{
    public function render(GenerationContext $context)
    {
        $cells = $context->getCells();
        $maxWidth = array_reduce($cells, function ($max, $current) {
            return $max > count($current) ? $max : count($current);
        }, 0);

        printf("Generation %d / %d\n", $context->getIteration(), $context->getIterationCount());
        printf(" %s\n", str_repeat('_', $maxWidth));

        $isDead = true;
        foreach ($cells as $x => $cellY) {
            echo '|';
            foreach ($cellY as $y => $cellX) {
                if ($cells[$x][$y] > 0) {
                    $isDead = false;
                    echo $cells[$x][$y];
                } else {
                    echo ' ';
                }
            }

            echo str_repeat(' ', ($maxWidth - count($cellY)));
            echo '|' , PHP_EOL;
        }

        printf(" %s\n", str_repeat('-', $maxWidth));

        if ($isDead) {
            die(sprintf("Universe is dead at generation %d\n", $context->getIteration()));
        }
    }
}
