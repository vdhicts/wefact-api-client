<?php

namespace Vdhicts\WeFact\Contracts;

interface ResponseContract
{
    public const STATUS_ERROR = 'error';
    public const STATUS_SUCCESS = 'success';

    public function getController(): string;
    public function getAction(): string;
    public function getStatus(): string;
    public function isSuccess(): bool;
    public function getData(string $key = null);
}