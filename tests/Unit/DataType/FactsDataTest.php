<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataType;

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
            measurementFormat: $measurementFormat = uniqid(),
            measurementValues: $measurementValues = uniqid(),
            nutritionFactsData: $exampleData,
        );

        $this->assertSame($exampleData, $sut->getNutritionFactsData());
        $this->assertSame($measurementFormat, $sut->getMeasurementFormat());
        $this->assertSame($measurementValues, $sut->getMeasurementValues());
    }
}
