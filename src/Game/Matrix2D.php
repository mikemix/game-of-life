<?php

namespace mikemix\GameOfLife\Game;

interface Matrix2D
{
    /**
     * @return Cell[][]
     */
    public function getCells(): array;

    public function getCellLivesLeft(int $x, int $y): int;

    public function tick(): Matrix2D;
}