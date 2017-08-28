<?php

namespace mikemix\Tests\GameOfLife\Game;

use mikemix\GameOfLife\Game\Cell;
use PHPUnit\Framework\TestCase;

final class CellTest extends TestCase
{
    public function testAliveCreatesCellWithMaximumLivesLeft()
    {
        $cell = Cell::alive();

        $this->assertEquals(Cell::DEFAULT_LIVES, $cell->getLivesLeft());
    }

    public function testAliveCreatesAliveCell()
    {
        $this->assertTrue(Cell::alive()->isAlive());
    }

    public function testDeadCreatesCellWithNoLivesLeft()
    {
        $cell = Cell::dead();

        $this->assertEquals(0, $cell->getLivesLeft());
    }

    public function testDeadCreatesDeadCell()
    {
        $this->assertFalse(Cell::dead()->isAlive());
    }

    public function testTickOnAliveCellWithTwoAliveNeighborsCreatesCellCopy()
    {
        $cell = Cell::alive();
        $newCell = $cell->tick(2);

        $this->assertNotSame($cell, $newCell);
        $this->assertEquals($cell, $newCell);
    }

    public function testTickOnAliveCellWithThreeAliveNeighborsCreatesCellCopy()
    {
        $cell = Cell::alive();
        $newCell = $cell->tick(3);

        $this->assertNotSame($cell, $newCell);
        $this->assertEquals($cell, $newCell);
    }

    public function testTickOnAliveCellWithFourAliveNeighborsCreatesDyingCopyOfOverpopulation()
    {
        $cell = Cell::alive();
        $newCell = $cell->tick(4);

        $this->assertNotSame($cell, $newCell);
        $this->assertEquals($cell->getLivesLeft() - 1, $newCell->getLivesLeft());
    }

    public function testTickOnAliveCellWithOneAliveNeighborCreatesDyingCopyOfUnderpopulation()
    {
        $cell = Cell::alive();
        $newCell = $cell->tick(1);

        $this->assertNotSame($cell, $newCell);
        $this->assertEquals($cell->getLivesLeft() - 1, $newCell->getLivesLeft());
    }

    public function testTickOnDeadCellWithThreeAliveNeighborsCreatesDeadCopy()
    {
        $cell = Cell::dead();
        $newCell = $cell->tick(3);

        $this->assertNotSame($cell, $newCell);
        $this->assertTrue($newCell->isAlive());
    }

    public function testTickOnDeadCellWithOneAliveNeighborCreatesDeadCopy()
    {
        $cell = Cell::dead();
        $newCell = $cell->tick(1);

        $this->assertNotSame($cell, $newCell);
        $this->assertFalse($newCell->isAlive());
    }

    public function testTickOnDeadCellWithTwoAliveNeighborsCreatesDeadCopy()
    {
        $cell = Cell::dead();
        $newCell = $cell->tick(2);

        $this->assertNotSame($cell, $newCell);
        $this->assertFalse($newCell->isAlive());
    }

    public function testTickOnDeadCellWithFourAliveNeighborsCreatesDeadCopy()
    {
        $cell = Cell::dead();
        $newCell = $cell->tick(4);

        $this->assertNotSame($cell, $newCell);
        $this->assertFalse($newCell->isAlive());
    }
}
