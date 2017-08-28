<?php
require 'vendor/autoload.php';

use mikemix\GameOfLife;

$width = getenv('GAME_WIDTH') ?: 20;
$height = getenv('GAME_HEIGHT') ?: $width * 2;
$tickCount = getenv('TICK_COUNT') ?: 50;

$universe = GameOfLife\Universe::createWithRandomSeed($width, $height);

$renderer = new GameOfLife\Renderer\Cli();
$renderer->render($universe);

for ($i = 0; $i < $tickCount; $i++) {
    usleep(500000);
    $universe = $universe->tick();
    $renderer->render($universe);
}
