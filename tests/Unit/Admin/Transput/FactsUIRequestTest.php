<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Admin\Transput;

use FreshAdvance\NutritionFacts\Admin\Exception\MissingRequestParameter;
use FreshAdvance\NutritionFacts\Admin\Transput\FactsUIRequest;
use OxidEsales\Eshop\Core\Request;
use PHPUnit\Framework\TestCase;

class FactsUIRequestTest extends TestCase
{
    public function testGetProductId(): void
    {
        $exampleProductId = uniqid();
        $requestStub = $this->createStub(Request::class);
        $requestStub->method('getRequestParameter')
            ->with(FactsUIRequest::REQUEST_KEY_PRODUCT_ID)
            ->willReturn($exampleProductId);

        $sut = new FactsUIRequest(
            shopRequest: $requestStub
        );

        $this->assertSame($exampleProductId, $sut->getProductId());
    }

    public function testGetProductIdException(): void
    {
        $requestMock = $this->createStub(Request::class);
        $requestMock->method('getRequestParameter')
            ->with(FactsUIRequest::REQUEST_KEY_PRODUCT_ID)
            ->willReturn(null);

        $sut = new FactsUIRequest(
            shopRequest: $requestMock
        );

        $this->expectException(MissingRequestParameter::class);
        $sut->getProductId();
    }
}
