<?php

namespace mikemix\GameOfLife\Game;

final class Matrix
{
    /** @var Cell[][] */
    private $cells;
    private $width;
    private $height;

    public function __construct(int $width, int $height)
    {
        if ($width < 5 || $height < 5) {
            throw new \InvalidArgumentException('At least 5x5 matrix required');
        }

        $this->width = $width;
        $this->height = $height;

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $this->cells[$x][$y] = Cell::dead();
            }
        }
    }

    public static function random(int $width, int $height): self
    {
        $matrix = new self($width, $height);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $matrix->cells[$x][$y] = mt_rand(0, 10) < 4 ? Cell::alive() : Cell::dead();
            }
        }

        return $matrix;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function isCellAlive(int $x, int $y): bool
    {
        return $this->cells[$x][$y]->isAlive();
    }

    public function tick(): self
    {
        $matrix = new self($this->width, $this->height);

        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $aliveNeighbors = $this->getAliveNeighborCount($x, $y);
                $matrix->cells[$x][$y] = $matrix->cells[$x][$y]->tick($aliveNeighbors);
            }
        }

        return $matrix;
    }

    private function getAliveNeighborCount($x, $y): int
    {
        $n1 = $this->isNeighborAlive($x-1, $y-1);
        $n2 = $this->isNeighborAlive($x-1, $y);
        $n3 = $this->isNeighborAlive($x-1, $y+1);
        $n4 = $this->isNeighborAlive($x, $y-1);
        $n5 = $this->isNeighborAlive($x, $y+1);
        $n6 = $this->isNeighborAlive($x+1, $y-1);
        $n7 = $this->isNeighborAlive($x+1, $y);
        $n8 = $this->isNeighborAlive($x+1, $y+1);

        return $n1 + $n2 + $n3 + $n4 + $n5 + $n6 + $n7 + $n8;
    }

    private function isNeighborAlive($x, $y): int
    {
        return isset($this->cells[$x][$y]) ? (int) $this->cells[$x][$y]->isAlive() : 0;
    }
}
