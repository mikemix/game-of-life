Conway's Game of Life
=====================

![Build](https://scrutinizer-ci.com/g/mikemix/game-of-life/badges/build.png?b=master)
![Code Quality](https://scrutinizer-ci.com/g/mikemix/game-of-life/badges/quality-score.png?b=master)
![Coverage](https://scrutinizer-ci.com/g/mikemix/game-of-life/badges/coverage.png?b=master)

Simple PHP implementation with CLI visualization.

## Run

In console:

`docker run --rm -v $PWD:/app composer/composer start`

Different matrix setups:

- Random matrix
  `docker run --rm -v $PWD:/app -e MATRIX=random composer/composer start`
- Glider gun
  `docker run --rm -v $PWD:/app -e MATRIX=glider_gun composer/composer start`

## Running test suite

`docker run --rm -v $PWD:/app composer/composer tests`

## TODO

- [x] Tests
- [x] Increase cell lifetime to survive more than one generation instead of killing instantly
- [x] Predefined seeds like Gosper's glider gun!
- [ ] Cell colors!

## Resources

* https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life

