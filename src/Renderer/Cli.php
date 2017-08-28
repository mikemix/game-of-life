<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Universe;

final class Cli implements Renderer
{
    public function render(Universe $universe)
    {
        $visualization = $universe->getVisualization();

        printf("\nGeneration %d\n", $visualization->getGeneration());
        printf(" %s\n", str_repeat('_', $visualization->getHeight()));

        foreach ($visualization->getCells() as $cellX) {
            echo '|';

            foreach ($cellX as $cellY) {
                echo $cellY ? 'x' : ' ';
            }

            echo '|' , PHP_EOL;
        }

        printf(" %s\n", str_repeat('-', $visualization->getHeight()));

        foreach ($visualization->getCells() as $cellX) {
            foreach ($cellX as $cellY) {
                if ($cellY) {
                    return;
                }
            }
        }

        die(sprintf("Universe is dead at generation %d\n", $visualization->getGeneration()));
    }
}
