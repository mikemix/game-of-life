<?php

namespace mikemix\GameOfLife\Game;

final class Universe
{
    private $matrix;
    private $generation = 1;

    public function __construct(Matrix2D $matrix)
    {
        $this->matrix = $matrix;
    }

    public function getContext(int $tickCount): GenerationContext
    {
        $matrix = [];

        foreach ($this->matrix->getCells() as $x => $cellY) {
            foreach ($cellY as $y => $cellX) {
                $matrix[$x][$y] = $this->matrix->getCellLivesLeft($x, $y);
            }
        }

        return new GenerationContext($this->generation, $tickCount, $matrix);
    }

    public function tick(): Universe
    {
        $universe = new self($this->matrix->tick());
        $universe->generation = $this->generation + 1;

        return $universe;
    }
}
