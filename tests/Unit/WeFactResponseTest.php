<?php

namespace Vdhicts\WeFact\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\WeFact\Contracts\ResponseContract;
use Vdhicts\WeFact\WeFactResponse;

class WeFactResponseTest extends TestCase
{
    public function testSuccessResponse(): void
    {
        $controller = 'creditor';
        $action = 'add';
        $status = 'success';
        $data = ['creditor' => [
            'CompanyName' => 'FooBar',
        ]];

        $response = new WeFactResponse($controller, $action, $status, $data);

        $this->assertInstanceOf(ResponseContract::class, $response);
        $this->assertSame($controller, $response->getController());
        $this->assertSame($action, $response->getAction());
        $this->assertTrue($response->isSuccess());
        $this->assertSame($status, $response->getStatus());
        $this->assertCount(1, $response->getData());
        $this->assertIsArray($response->getData('creditor'));
        $this->assertSame('FooBar', $response->getData('creditor.CompanyName'));
    }

    public function testErrorResponse()
    {
        $controller = 'creditor';
        $action = 'lol';
        $status = 'error';
        $data = ['errors' => ['Invalid action']];

        $response = new WeFactResponse($controller, $action, $status, $data);
        $this->assertSame($controller, $response->getController());
        $this->assertSame($action, $response->getAction());
        $this->assertFalse($response->isSuccess());
        $this->assertSame($status, $response->getStatus());
        $this->assertIsArray($response->getData('errors'));
    }
}