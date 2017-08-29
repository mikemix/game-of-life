<?php

namespace mikemix\GameOfLife\Game;

final class RandomMatrix extends AbstractMatrix2D
{
    private $probability;

    public function __construct(int $width, int $height, int $probability = 3)
    {
        $this->probability = $probability;
        if ($this->probability < 1 || $this->probability > 9) {
            throw new \InvalidArgumentException('Probability between 1-9 expected');
        }

        $cells = [];
        for ($x = 0; $x < $height; $x++) {
            for ($y = 0; $y < $width; $y++) {
                $cells[$x][$y] = mt_rand(0, 9) < $this->probability ? Cell::alive() : Cell::dead();
            }
        }

        parent::__construct($cells);
    }
}
