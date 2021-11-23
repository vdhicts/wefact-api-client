<?php

namespace Vdhicts\WeFact;

use Illuminate\Support\Arr;
use Vdhicts\WeFact\Contracts\ResponseContract;

class WeFactResponse implements ResponseContract
{
    private string $controller;
    private string $action;
    private string $status;
    private array $data;

    public function __construct(
        string $controller,
        string $action,
        string $status = ResponseContract::STATUS_ERROR,
        array $data = []
    ) {
        $this->controller = $controller;
        $this->action = $action;
        $this->status = $status;
        $this->data = $data;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isSuccess(): bool
    {
        return $this->status === self::STATUS_SUCCESS;
    }

    /**
     * @return mixed
     */
    public function getData(string $key = null)
    {
        if (is_null($key)) {
            return $this->data;
        }

        return Arr::get($this->data, $key);
    }
}