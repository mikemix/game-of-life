Conway's Game of Life
=====================

Simple PHP implementation with CLI visualization.

## Run

In console:

`docker run --rm -v $PWD:/app composer/composer start`

Different matrix size:

`docker run --rm -v $PWD:/app -e GAME_WIDTH=10 -e GAME_HEIGHT=20 composer/composer start`

## TODO

1. Tests
2. Increase cell lifetime to survive more than one generation instead of killing instantly

## Resources

* https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life

