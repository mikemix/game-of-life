<?php

namespace mikemix\Tests\GameOfLife\Game;

use mikemix\GameOfLife\Game\AbstractMatrix2D;
use mikemix\GameOfLife\Game\Cell;
use PHPUnit\Framework\TestCase;

final class AbstractMatrixTest extends TestCase
{
    private function createMatrix(array $matrix): AbstractMatrix2D
    {
        return new class ($matrix) extends AbstractMatrix2D {
        };
    }

    /**
     * @param int $livesLeft
     * @param int $x
     * @param int $y
     * @dataProvider cellValuesProvider
     */
    public function testGetCellLivesLeft(int $livesLeft, int $x, int $y)
    {
        $matrix = $this->createMatrix([
            [Cell::dead(), Cell::dead()],
            [Cell::dead(), Cell::alive()],
        ]);

        $this->assertEquals($livesLeft, $matrix->getCellLivesLeft($x, $y));
    }

    public function cellValuesProvider(): array
    {
        return [
            [0, 0, 0],
            [0, 0, 1],
            [0, 1, 0],
            [Cell::DEFAULT_LIVES, 1, 1],
        ];
    }

    public function testTickIsImmutable()
    {
        $matrix = $this->createMatrix([]);
        $tick = $matrix->tick();

        $this->assertNotSame($matrix, $tick);
    }

    public function testTick()
    {
        $seed = $this->createMatrix([
            [Cell::alive(), Cell::alive(), Cell::dead()],
            [Cell::alive(), Cell::alive(), Cell::dead()],
            [Cell::alive(), Cell::dead(), Cell::dead()],
        ]);

        $tick = $seed->tick();

        $this->assertEquals(Cell::DEFAULT_LIVES, $tick->getCellLivesLeft(0, 0));
        $this->assertEquals(Cell::DEFAULT_LIVES, $tick->getCellLivesLeft(0, 1));
        $this->assertEquals(0, $tick->getCellLivesLeft(0, 2));

        $this->assertEquals(0, $tick->getCellLivesLeft(1, 0));
        $this->assertEquals(0, $tick->getCellLivesLeft(1, 1));
        $this->assertEquals(0, $tick->getCellLivesLeft(1, 2));

        $this->assertEquals(Cell::DEFAULT_LIVES, $tick->getCellLivesLeft(2, 0));
        $this->assertEquals(Cell::DEFAULT_LIVES, $tick->getCellLivesLeft(2, 1));
        $this->assertEquals(0, $tick->getCellLivesLeft(2, 2));
    }
}