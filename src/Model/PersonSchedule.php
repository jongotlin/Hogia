<?php

namespace JGI\Hogia\Model;

class PersonSchedule
{
    private string $employmentId;
    /**
     * @var Period[]
     */
    private array $periods;

    public function __construct(string $employmentId, array $periods)
    {
        $this->employmentId = $employmentId;
        $this->periods = $periods;
    }

    public function getEmploymentId(): string
    {
        return $this->employmentId;
    }

    public function getPeriods(): array
    {
        return $this->periods;
    }

    public function getFirstPeriod(): ?Period
    {
        /** @var Period|null $first */
        $first = null;
        foreach ($this->getPeriods() as $period) {
            if (!$first || $period->getStart() < $first->getStart()) {
                $first = $period;
            }
        }

        return $first;
    }
}
