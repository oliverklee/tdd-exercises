<?php
declare(strict_types=1);

namespace OliverKlee\TddSeed\RocketScience;

class RocketLauncher
{
    /**
     * @var Rocket[]
     */
    private array $rockets = [];

    public function addRocket(Rocket $rocket): void
    {
        $this->rockets[] = $rocket;
    }

    /**
     * @return Rocket[]
     */
    public function getRockets(): array
    {
        return $this->rockets;
    }

    public function activate()
    {
        foreach ($this->rockets as $rocket){
            $rocket->launch();
        }
    }
}
