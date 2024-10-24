<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Integration\Repository;

use FreshAdvance\NutritionFacts\DataType\FactsData;
use FreshAdvance\NutritionFacts\DataType\FactsDataInterface;
use FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

class FactsDataAccessTest extends IntegrationTestCase
{
    public function testDataFlow(): void
    {
        $sut = $this->getSut();
        $productId = uniqid();

        $originalData = $this->createRandomFactsData();

        $this->assertTrue($sut->saveFactsData($productId, $originalData));

        $loadedData = $sut->getFactsData($productId);
        $this->assertDataObjectsEquals($originalData, $loadedData);

        $updatedData = $this->createRandomFactsData();
        $sut->saveFactsData($productId, $updatedData);

        $loadedData = $sut->getFactsData($productId);
        $this->assertDataObjectsEquals($updatedData, $loadedData);
    }

    protected function getSut(): FactsDataAccessInterface
    {
        return $this->get(FactsDataAccessInterface::class);
    }

    protected function createRandomFactsData(): FactsDataInterface
    {
        return new FactsData(
            measurementFormat: uniqid(),
            measurementValues: uniqid(),
            nutritionFactsData: [
                uniqid() => uniqid(),
                uniqid() => uniqid(),
            ]
        );
    }

    protected function assertDataObjectsEquals(FactsDataInterface $originalData, FactsDataInterface $loadedData): void
    {
        $this->assertEquals($originalData->getNutritionFactsData(), $loadedData->getNutritionFactsData());
        $this->assertEquals($originalData->getMeasurementFormat(), $loadedData->getMeasurementFormat());
        $this->assertEquals($originalData->getMeasurementValues(), $loadedData->getMeasurementValues());
    }
}
