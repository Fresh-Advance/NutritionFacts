<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataTypeFactory;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\FactsDataFactory;
use PHPUnit\Framework\TestCase;

class FactsDataFactoryTest extends TestCase
{
    public function testGetFromProductFacts(): void
    {
        $sut = new FactsDataFactory();

        $productFactsStub = $this->createConfiguredMock(ProductFactsInterface::class, [
            'getNutritionFacts' => $this->createConfiguredMock(NutritionFactsInterface::class, [
                'getCalories' => $calories = uniqid(),
                'getTotalFat' => $totalFat = uniqid(),
                'getSaturatedFat' => $saturatedFat = uniqid(),
                'getTransFat' => $transFat = uniqid(),
                'getCarbohydrates' => $carbohydrates = uniqid(),
                'getFibre' => $fibre = uniqid(),
                'getSugars' => $sugars = uniqid(),
                'getProtein' => $protein = uniqid(),
                'getCholesterol' => $cholesterol = uniqid(),
                'getSodium' => $sodium = uniqid(),
            ])
        ]);

        $result = $sut->getFromProductFacts($productFactsStub);

        $this->assertEquals([
            'calories' => $calories,
            'totalFat' => $totalFat,
            'saturatedFat' => $saturatedFat,
            'transFat' => $transFat,
            'carbohydrates' => $carbohydrates,
            'fibre' => $fibre,
            'sugars' => $sugars,
            'protein' => $protein,
            'cholesterol' => $cholesterol,
            'sodium' => $sodium,
        ], $result->getNutritionFactsData());
    }
}
