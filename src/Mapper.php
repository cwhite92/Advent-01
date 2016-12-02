<?php

namespace Advent;

class Mapper
{
    protected $x = 0;
    protected $y = 0;
    protected $direction = 1;

    const DIRECTION_N = 1;
    const DIRECTION_E = 2;
    const DIRECTION_S = 3;
    const DIRECTION_W = 4;

    public function distance(string $instructions): int
    {
        $this->resetToStartPoint();

        $instructions = explode(', ', $instructions);

        foreach ($instructions as $instruction) {
            list($direction, $distance) = $this->parseInstruction($instruction);

            $this->changeDirection($direction);
            $this->walk($distance);
        }

        $this->x = abs($this->x);
        $this->y = abs($this->y);

        return $this->x + $this->y;
    }

    protected function resetToStartPoint()
    {
        $this->x = 0;
        $this->y = 0;
        $this->direction = static::DIRECTION_N;
    }

    protected function parseInstruction(string $instruction): array
    {
        return [
            substr($instruction, 0, 1),
            substr($instruction, 1)
        ];
    }

    protected function changeDirection($direction)
    {
        switch ($direction) {
            case 'L':
                $this->direction--;
                break;
            case 'R':
                $this->direction++;
        }

        if ($this->direction == 5) {
            $this->direction = static::DIRECTION_N;
        }

        if ($this->direction == 0) {
            $this->direction = static::DIRECTION_W;
        }
    }

    protected function walk($distance)
    {
        switch ($this->direction) {
            case static::DIRECTION_N:
                $this->y += $distance;
                break;
            case static::DIRECTION_E:
                $this->x += $distance;
                break;
            case static::DIRECTION_S:
                $this->y -= $distance;
                break;
            case static::DIRECTION_W:
                $this->x -= $distance;
        }
    }
}
