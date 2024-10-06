<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Integration\Repository;

use FreshAdvance\NutritionFacts\DataType\FactsData;
use FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

class FactsDataAccessTest extends IntegrationTestCase
{
    public function testDataFlow(): void
    {
        $sut = $this->getSut();
        $productId = uniqid();

        $originalData = new FactsData(
            nutritionFactsData: [
                uniqid() => uniqid(),
                uniqid() => uniqid(),
            ]
        );

        $this->assertTrue($sut->saveFactsData($productId, $originalData));

        $loadedData = $sut->getFactsData($productId);
        $this->assertEquals($originalData->getNutritionFactsData(), $loadedData->getNutritionFactsData());
    }

    public function getSut(): FactsDataAccessInterface
    {
        return $this->get(FactsDataAccessInterface::class);
    }
}
