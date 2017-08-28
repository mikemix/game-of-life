<?php

namespace mikemix\GameOfLife\Game;

final class RandomMatrix extends AbstractMatrix2D
{
    private $probability;

    public function __construct(int $width, int $height, int $probability = null)
    {
        $this->probability = $probability ?: 3;
        if ($this->probability < 1 || $this->probability > 9) {
            throw new \InvalidArgumentException('Probability between 1-9 expected');
        }

        $cells = [];
        for ($x = 0; $x < $height; $x++) {
            for ($y = 0; $y < $width; $y++) {
                $cells[$x][$y] = mt_rand(0, $this->probability) < 2 ? Cell::alive() : Cell::dead();
            }
        }

        parent::__construct($cells);
    }
}
