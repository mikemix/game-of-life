<?php

namespace mikemix\GameOfLife\Game;

final class MatrixDto
{
    private $generation;
    private $width;
    private $height;
    private $cells;

    /**
     * @param int      $generation
     * @param int      $width
     * @param int      $height
     * @param bool[][] $cells
     */
    public function __construct(int $generation, int $width, int $height, array $cells)
    {
        $this->generation = $generation;
        $this->width = $width;
        $this->height = $height;
        $this->cells = $cells;
    }

    public function getCells(): array
    {
        return $this->cells;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getGeneration(): int
    {
        return $this->generation;
    }
}
