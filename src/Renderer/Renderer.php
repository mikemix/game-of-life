<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Universe;

interface Renderer
{
    public function render(Universe $universe);
}
