<?php

namespace Vdhicts\WeFact\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\WeFact\Contracts\RequestContract;
use Vdhicts\WeFact\WeFactRequest;

class WeFactRequestTest extends TestCase
{
    public function testRequest(): void
    {
        $controller = 'creditor';
        $action = 'add';
        $params = ['CompanyName' => 'FooBar'];

        $request = new WeFactRequest($controller, $action, $params);

        $this->assertInstanceOf(RequestContract::class, $request);
        $this->assertSame($controller, $request->getController());
        $this->assertSame($action, $request->getAction());
        $this->assertCount(1, $request->getParams());
    }
}