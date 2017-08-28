<?php

namespace mikemix\GameOfLife\Renderer;

use mikemix\GameOfLife\Game\MatrixDto;

interface Renderer
{
    public function render(MatrixDto $dto);
}
