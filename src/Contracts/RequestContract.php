<?php

namespace Vdhicts\WeFact\Contracts;

interface RequestContract
{
    public function getController(): string;

    public function getAction(): string;

    public function getParams(): array;

    public function getRequestData(): array;
}
