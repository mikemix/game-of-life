<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Game\MatrixDto;

final class Cli implements Renderer
{
    public function render(MatrixDto $dto)
    {
        printf("\nGeneration %d\n", $dto->getGeneration());
        printf(" %s\n", str_repeat('_', $dto->getHeight()));

        foreach ($dto->getCells() as $cellX) {
            echo '|';

            foreach ($cellX as $cellY) {
                echo $cellY ? 'x' : ' ';
            }

            echo '|' , PHP_EOL;
        }

        printf(" %s\n", str_repeat('-', $dto->getHeight()));

        foreach ($dto->getCells() as $cellX) {
            foreach ($cellX as $cellY) {
                if ($cellY) {
                    return;
                }
            }
        }

        die(sprintf("Universe is dead at generation %d\n", $dto->getGeneration()));
    }
}
