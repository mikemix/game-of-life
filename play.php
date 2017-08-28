<?php
require 'vendor/autoload.php';

use mikemix\GameOfLife;

$width = getenv('GAME_WIDTH') ?: 20;
$height = getenv('GAME_HEIGHT') ?: $width * 2;

$universe = GameOfLife\Universe::createWithRandomSeed($width, $height);

$renderer = new GameOfLife\Renderer\Cli();
$renderer->render($universe->getVisualization());

for ($i = 0; $i < 100; $i++) {
    usleep(500000);
    $universe = $universe->tick();
    $renderer->render($universe->getVisualization());
}
