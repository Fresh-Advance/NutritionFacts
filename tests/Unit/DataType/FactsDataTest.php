<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace DataType;

use FreshAdvance\NutritionFacts\DataType\FactsData;
use PHPUnit\Framework\TestCase;

class FactsDataTest extends TestCase
{
    public function testGetEmptyNutritionFactsData(): void
    {
        $sut = new FactsData();
        $this->assertSame([], $sut->getNutritionFactsData());
    }

    public function testNotEmptyNutritionFactsData(): void
    {
        $exampleData = [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ];

        $sut = new FactsData(
            nutritionFactsData: $exampleData
        );
        $this->assertSame($exampleData, $sut->getNutritionFactsData());
    }
}
