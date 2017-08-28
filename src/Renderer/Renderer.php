<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Game\GenerationContext;

interface Renderer
{
    public function render(GenerationContext $context);
}
