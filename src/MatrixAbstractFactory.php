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
            case 'random': return $this->createRandomMatrix();
            case 'glider_gun': return $this->createGliderGunMatrix();
            default:
                throw new \InvalidArgumentException('Invalid matrix name');
        }
    }

    private function createRandomMatrix(): RandomMatrix
    {
        $height = (int) getenv('MATRIX_HEIGHT') ?: 20;
        $width = (int) getenv('MATRIX_WIDTH') ?: $height * 3;
        $probability = (int) getenv('MATRIX_PROBABILITY') ?: 3;

        return new RandomMatrix($width, $height, $probability);
    }

    private function createGliderGunMatrix(): GliderGunMatrix
    {
        return new GliderGunMatrix();
    }
}
