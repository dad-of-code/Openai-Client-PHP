<?php

/**
 * Copyright (c) 2022 Tectalic (https://tectalic.com)
 *
 * For copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * Please see the README.md file for usage instructions.
 */

declare(strict_types=1);

namespace Tests\Unit\Handlers;

use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Tectalic\OpenAi\Authentication;
use Tectalic\OpenAi\ClientException;
use Tectalic\OpenAi\Handlers\Engines;
use Tectalic\OpenAi\Manager;
use Tests\AssertValidateTrait;
use Tests\MockHttpClient;

final class EnginesTest extends TestCase
{
    use AssertValidateTrait;

    /** @var MockHttpClient */
    private $mockClient;

    protected function setUp(): void
    {
        $this->mockClient = new MockHttpClient();
        Manager::build(
            $this->mockClient,
            new Authentication('token')
        );
    }

    protected function tearDown(): void
    {
        $reflectionClass = new ReflectionClass(Manager::class);
        $reflectionProperty = $reflectionClass->getProperty('client');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue(null);
    }

    public function testMissingRequest(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Request not configured.');
        (new Engines())->getRequest();
    }

    public function testUnsupportedContentTypeResponse(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Unsupported content type: text/plain');

        $this->mockClient->makeResponse(
            new Response(
                200,
                ['Content-Type' => 'text/plain'],
                null
            )
        );
        (new Engines())->list()->toArray();
    }

    public function testInvalidJsonResponse(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('Failed to parse JSON response body: Syntax error');

        $this->mockClient->makeResponse(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                'invalidJson'
            )
        );
        (new Engines())->list()->toArray();
    }

    public function testUnsuccessfulResponseCode(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionMessage("Unsuccessful response. HTTP status code: 418 (I'm a teapot).");

        $this->mockClient->makeResponse(new Response(418));
        (new Engines())->list()->toModel();
    }

    public function testListMethod(): void
    {
        $request = (new Engines())
            ->list()
            ->getRequest();
        $this->assertValidate($request);
    }

    public function testRetrieveMethod(): void
    {
        $request = (new Engines())
            ->retrieve('davinci')
            ->getRequest();
        $this->assertValidate($request);
    }
}
