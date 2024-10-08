<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Twig\Extension;

use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;
use FreshAdvance\NutritionFacts\Service\FactsServiceInterface;
use FreshAdvance\NutritionFacts\Twig\Extension\ProductFactsExtension;
use PHPUnit\Framework\TestCase;

class ProductFactsExtensionTest extends TestCase
{
    public function testGetProductFacts(): void
    {
        $productId = uniqid();

        $sut = new ProductFactsExtension(
            factsService: $factsServiceMock = $this->createMock(FactsServiceInterface::class)
        );

        $factsServiceMock->method('getProductFacts')
            ->with($productId)
            ->willReturn($productFactsStub = $this->createStub(ProductFactsInterface::class));

        $this->assertSame($productFactsStub, $sut->getProductFacts($productId));
    }

    public function testGetFunctions(): void
    {
        $sut = new ProductFactsExtension(
            factsService: $this->createStub(FactsServiceInterface::class)
        );

        $functions = $sut->getFunctions();

        $first = reset($functions);
        $this->assertSame('faGetProductFacts', $first->getName());
    }
}
