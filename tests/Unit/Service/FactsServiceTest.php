<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Settings;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Repository\FactsRepositoryInterface;
use FreshAdvance\NutritionFacts\Service\FactsService;
use FreshAdvance\NutritionFacts\Service\FactsServiceInterface;
use PHPUnit\Framework\TestCase;

class FactsServiceTest extends TestCase
{
    public function testGetFacts(): void
    {
        $productId = uniqid();
        $factsListStub = $this->createStub(NutritionFactsListInterface::class);
        $sut = $this->getSut(
            factsRepository: $factsRepositoryStub = $this->createMock(FactsRepositoryInterface::class),
        );

        $factsRepositoryStub->method('getFactsList')->with($productId)->willReturn($factsListStub);

        $this->assertSame($factsListStub, $sut->getProductNutritionFacts($productId));
    }

    public function getSut(
        FactsRepositoryInterface $factsRepository = null,
    ): FactsServiceInterface {
        return new FactsService(
            factsRepository: $factsRepository ?? $this->createMock(FactsRepositoryInterface::class),
        );
    }
}
