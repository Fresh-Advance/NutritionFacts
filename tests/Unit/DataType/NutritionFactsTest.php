<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataType;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use PHPUnit\Framework\TestCase;

class NutritionFactsTest extends TestCase
{
    public function testGetters(): void
    {
        $sut = new NutritionFacts(
            calories: $calories = rand(0, 1000),
            totalFat: $totalFat = rand(0, 1000),
            saturatedFat: $saturatedFat = rand(0, 1000),
            transFat: $transFat = rand(0, 1000),
            carbohydrates: $carbohydrates = rand(0, 1000),
            fibre: $fibre = rand(0, 1000),
            sugars: $sugars = rand(0, 1000),
            protein: $protein = rand(0, 1000),
            cholesterol: $cholesterol = rand(0, 1000),
            sodium: $sodium = rand(0, 1000),
        );

        $this->assertEquals($calories, $sut->getCalories());
        $this->assertEquals($totalFat, $sut->getTotalFat());
        $this->assertEquals($saturatedFat, $sut->getSaturatedFat());
        $this->assertEquals($transFat, $sut->getTransFat());
        $this->assertEquals($carbohydrates, $sut->getCarbohydrates());
        $this->assertEquals($fibre, $sut->getFibre());
        $this->assertEquals($sugars, $sut->getSugars());
        $this->assertEquals($protein, $sut->getProtein());
        $this->assertEquals($cholesterol, $sut->getCholesterol());
        $this->assertEquals($sodium, $sut->getSodium());
    }
}