<?php

namespace mikemix\GameOfLife\Game;

abstract class AbstractMatrix2D implements Matrix2D
{
    /** @var Cell[][] */
    protected $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return Cell[][]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    public function getCellLivesLeft(int $x, int $y): int
    {
        return $this->cells[$x][$y]->getLivesLeft();
    }

    public function tick(): Matrix2D
    {
        $matrix = clone $this;

        foreach ($matrix->cells as $x => $cellY) {
            foreach ($cellY as $y => $cellX) {
                $aliveNeighbors = $this->getAliveNeighborCount($x, $y);
                $matrix->cells[$x][$y] = $this->cells[$x][$y]->tick($aliveNeighbors);
            }
        }

        return $matrix;
    }

    /**
     * @param array $array
     *
     * @return Cell[][]
     */
    public static function bitArrayToCellArray(array $array): array
    {
        $matrix = [];

        foreach ($array as $x => $bitX) {
            foreach ($bitX as $y => $bitY) {
                $matrix[$x][$y] = $bitY ? Cell::alive() : Cell::dead();
            }
        }

        return $matrix;
    }

    private function getAliveNeighborCount($x, $y): int
    {
        $n1 = $this->getOneIfCellAliveAt($x-1, $y-1);
        $n2 = $this->getOneIfCellAliveAt($x-1, $y);
        $n3 = $this->getOneIfCellAliveAt($x-1, $y+1);
        $n4 = $this->getOneIfCellAliveAt($x, $y-1);
        $n5 = $this->getOneIfCellAliveAt($x, $y+1);
        $n6 = $this->getOneIfCellAliveAt($x+1, $y-1);
        $n7 = $this->getOneIfCellAliveAt($x+1, $y);
        $n8 = $this->getOneIfCellAliveAt($x+1, $y+1);

        return $n1 + $n2 + $n3 + $n4 + $n5 + $n6 + $n7 + $n8;
    }

    private function getOneIfCellAliveAt($x, $y): int
    {
        return isset($this->cells[$x][$y]) ? (int) $this->cells[$x][$y]->isAlive() : 0;
    }
}
