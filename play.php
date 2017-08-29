<?php
require 'vendor/autoload.php';

use mikemix\GameOfLife;

$matrix = getenv('MATRIX');
if (empty($matrix)) {
    echo 'Matrix name missing' , PHP_EOL;
    exit(1);
}

$matrixFactory = new GameOfLife\MatrixAbstractFactory();
$universe = new GameOfLife\Game\Universe($matrixFactory->create($matrix));
$renderer = new GameOfLife\Renderer\Cli();

$tickCount = getenv('TICK_COUNT') ?: 120;

for ($tick = 0; $tick < $tickCount; $tick++) {
    $renderer->render($universe->getContext($tickCount));
    $universe = $universe->tick();
    usleep(90000);
}
