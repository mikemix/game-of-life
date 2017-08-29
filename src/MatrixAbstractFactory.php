<?php

namespace mikemix\GameOfLife;

use mikemix\GameOfLife\Game\GliderGunMatrix;
use mikemix\GameOfLife\Game\Matrix2D;
use mikemix\GameOfLife\Game\RandomMatrix;

final class MatrixAbstractFactory
{
    public function create(string $game): Matrix2D
    {
        switch ($game) {
            case 'random':
                $height = getenv('MATRIX_HEIGHT') ?: 20;
                $width = getenv('MATRIX_WIDTH') ?: $height * 3;
                $probability = getenv('MATRIX_PROBABILITY') ?: 3;

                return new RandomMatrix($width, $height, $probability);
            case 'glider_gun':
                return new GliderGunMatrix();
            default:
                throw new \InvalidArgumentException('Invalid matrix name');
        }
    }
}
