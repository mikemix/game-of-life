<?php

namespace mikemix\GameOfLife\Game;

interface Matrix2D
{
    /**
     * @return bool[][]
     */
    public function getCells(): array;

    public function isCellAlive(int $x, int $y): bool;

    public function tick(): Matrix2D;
}
