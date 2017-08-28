<?php

namespace mikemix\GameOfLife\Game;

final class GenerationContext
{
    private $iteration;
    private $iterationCount;
    private $cells;

    public function __construct(int $iteration, int $iterationCount, array $cells)
    {
        $this->iteration = $iteration;
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

    public function getIteration(): int
    {
        return $this->iteration;
    }

    public function getIterationCount(): int
    {
        return $this->iterationCount;
    }
}
