<?php

namespace mikemix\GameOfLife;

use mikemix\GameOfLife\Game\Matrix;
use mikemix\GameOfLife\Game\MatrixDto;

final class Universe
{
    private $width;
    private $height;
    private $matrix;
    private $generation = 1;

    private function __construct(int $width, int $height, Matrix $matrix, int $generation)
    {
        if ($width < 5 || $height < 5) {
            throw new \InvalidArgumentException('At least 5x5 universe required');
        }

        $this->width = $width;
        $this->height = $height;
        $this->matrix = $matrix;
        $this->generation = $generation;
    }

    public static function createWithRandomSeed(int $width, int $height): self
    {
        return new self($width, $height, Matrix::random($width, $height), 1);
    }

    public function getVisualization(): MatrixDto
    {
        $dto = [];

        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $dto[$x][$y] = $this->matrix->isCellAlive($x, $y);
            }
        }

        return new MatrixDto($this->generation, $this->width, $this->height, $dto);
    }

    public function tick(): Universe
    {
        return new self(
            $this->width,
            $this->height,
            $this->matrix->tick(),
            $this->generation + 1
        );
    }
}
