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
        return new GenerationContext($this->generation, $tickCount, $this->matrix->getCells());
    }

    public function tick(): Universe
    {
        $universe = new self($this->matrix->tick());
        $universe->generation = $this->generation + 1;

        return $universe;
    }
}
