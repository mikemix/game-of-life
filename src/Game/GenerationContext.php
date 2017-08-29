<?php

namespace mikemix\GameOfLife\Game;

final class GenerationContext
{
    private $generation;
    private $iterationCount;
    private $cells;

    public function __construct(int $generation, int $iterationCount, array $cells)
    {
        $this->generation = $generation;
        $this->iterationCount = $iterationCount;
        $this->cells = $cells;
    }

    /**
     * @return int[][]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    public function getGeneration(): int
    {
        return $this->generation;
    }

    public function getIterationCount(): int
    {
        return $this->iterationCount;
    }
}
