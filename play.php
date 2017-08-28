<?php
require 'vendor/autoload.php';

use mikemix\GameOfLife\{
    Game, Renderer
};

$height = getenv('GAME_HEIGHT') ?: 20;
$width = getenv('GAME_WIDTH') ?: $height * 3;
$tickCount = getenv('TICK_COUNT') ?: 100;

$matrix = new Game\RandomMatrix($width, $height, 2);
$universe = new Game\Universe($matrix);
$renderer = new Renderer\Cli();

for ($tick = 1; $tick <= $tickCount; $tick++) {
    usleep(50000);
    $universe = $universe->tick();
    $renderer->render($universe->getContext($tickCount));
}
