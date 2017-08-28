<?php
require 'vendor/autoload.php';

use mikemix\GameOfLife;

$universe = GameOfLife\Universe::createWithRandomSeed(
    getenv('GAME_WIDTH') ?: 20,
    getenv('GAME_HEIGHT') ?: 40
);

$renderer = new GameOfLife\Renderer\Cli();
$renderer->render($universe->getVisualization());

while (true) {
    usleep(500000);
    $universe = $universe->tick();
    $renderer->render($universe->getVisualization());
}
