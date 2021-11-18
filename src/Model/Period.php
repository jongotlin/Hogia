<?php

namespace JGI\Hogia\Model;

class Period
{
    private \DateTimeImmutable $start;
    private \DateTimeImmutable $end;

    public function __construct(\DateTimeImmutable $start, \DateTimeImmutable $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): \DateTimeImmutable
    {
        return $this->end;
    }

    public function getMinutes(): int
    {
        return ($this->getEnd()->getTimestamp() - $this->getStart()->getTimestamp()) / 60;
    }

    public function getLengthString()
    {
        $hours = floor($this->getMinutes() / 60);
        $minutes = $this->getMinutes() % 60;

        return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
    }
}
