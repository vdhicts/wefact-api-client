<?php

namespace Vdhicts\WeFact;

use Vdhicts\WeFact\Contracts\RequestContract;

class WeFactRequest implements RequestContract
{
    private string $controller;
    private string $action;
    private array $params;

    public function __construct(string $controller, string $action, array $params = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getRequestData(): array
    {
        return array_merge(
            [
                'controller' => $this->controller,
                'action' => $this->action,
            ],
            $this->params
        );
    }
}