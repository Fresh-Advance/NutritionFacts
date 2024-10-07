<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Service;

use FreshAdvance\NutritionFacts\DataType\FactsDataInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\FactsDataFactoryInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\NutritionFactsFactoryInterface;
use FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface;
use FreshAdvance\NutritionFacts\Service\FactsService;
use FreshAdvance\NutritionFacts\Service\FactsServiceInterface;
use PHPUnit\Framework\TestCase;

class FactsServiceTest extends TestCase
{
    public function testGetProductFacts(): void
    {
        $productId = uniqid();

        $sut = $this->getSut(
            factsDataAccess: $factsDataAccessMock = $this->createMock(FactsDataAccessInterface::class),
            nutritionFactsFactory: $nutrFactsFactoryMock = $this->createMock(NutritionFactsFactoryInterface::class),
        );

        $factsDataAccessMock->method('getFactsData')
            ->with($productId)
            ->willReturn($factsDataStub = $this->createStub(FactsDataInterface::class));

        $nutrFactsFactoryMock->method('getFromArray')
            ->with($factsDataStub->getNutritionFactsData())
            ->willReturn($nutritionFactsStub = $this->createStub(NutritionFactsInterface::class));

        $productFacts = $sut->getProductFacts($productId);

        $this->assertSame($nutritionFactsStub, $productFacts->getNutritionFacts());
    }

    public function testSaveProductFacts(): void
    {
        $productId = uniqid();

        $sut = $this->getSut(
            factsDataAccess: $factsDataAccessMock = $this->createMock(FactsDataAccessInterface::class),
            factsDataFactory: $factsDataFactoryMock = $this->createMock(FactsDataFactoryInterface::class),
        );

        $productFactsStub = $this->createStub(ProductFactsInterface::class);
        $factsDataFactoryMock->method('getFromProductFacts')
            ->with($productFactsStub)
            ->willReturn($factsDataStub = $this->createStub(FactsDataInterface::class));

        $factsDataAccessMock->expects($this->once())
            ->method('saveFactsData')
            ->with($productId, $factsDataStub)
            ->willReturn(true);

        $sut->saveProductFacts($productId, $productFactsStub);
    }

    public function getSut(
        FactsDataAccessInterface $factsDataAccess = null,
        NutritionFactsFactoryInterface $nutritionFactsFactory = null,
        FactsDataFactoryInterface $factsDataFactory = null,
    ): FactsServiceInterface {
        return new FactsService(
            factsDataAccess: $factsDataAccess ?? $this->createStub(FactsDataAccessInterface::class),
            nutritionFactsFactory: $nutritionFactsFactory ?? $this->createStub(NutritionFactsFactoryInterface::class),
            factsDataFactory: $factsDataFactory ?? $this->createStub(FactsDataFactoryInterface::class),
        );
    }
}
