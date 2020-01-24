<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use LaravelEnso\ControlPanelApi\App\Contracts\Sensor;
use LaravelEnso\Helpers\App\Classes\Obj;

abstract class BaseSensor implements Sensor
{
    private Obj $params;

    public function __construct(Obj $params)
    {
        $this->params = $params;
    }

    public function class(): string
    {
        return '';
    }

    protected function filter($query, $attribute = 'created_at')
    {
        return $query->when(
            $this->params->filled('startDate'), fn ($query) => $query
            ->where($attribute, '>=', $this->params->get('startDate'))
        )->when(
            $this->params->filled('endDate'), fn ($query) => $query
            ->where($attribute, '<=', $this->params->get('endDate'))
        );
    }
}