<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataTypeFactory;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\NutritionFactsFactory;
use PHPUnit\Framework\TestCase;

class NutritionFactsFactoryTest extends TestCase
{
    /** @dataProvider getFromArrayDataProvider */
    public function testGetFromArray(array $input, NutritionFactsInterface $output): void
    {
        $sut = new NutritionFactsFactory();
        $result = $sut->getFromArray($input);

        $this->assertEquals($output->getCalories(), $result->getCalories());
        $this->assertEquals($output->getTotalFat(), $result->getTotalFat());
        $this->assertEquals($output->getSaturatedFat(), $result->getSaturatedFat());
        $this->assertEquals($output->getTransFat(), $result->getTransFat());
        $this->assertEquals($output->getCarbohydrates(), $result->getCarbohydrates());
        $this->assertEquals($output->getFibre(), $result->getFibre());
        $this->assertEquals($output->getSugars(), $result->getSugars());
        $this->assertEquals($output->getProtein(), $result->getProtein());
        $this->assertEquals($output->getCholesterol(), $result->getCholesterol());
        $this->assertEquals($output->getSodium(), $result->getSodium());
    }

    public function getFromArrayDataProvider(): \Generator
    {
        yield 'empty array' => [
            'input' => [],
            'output' => new NutritionFacts()
        ];

        yield 'random array' => [
            'input' => [
                uniqid() => uniqid(),
                uniqid() => uniqid(),
            ],
            'output' => new NutritionFacts()
        ];

        yield 'calories' => [
            'input' => [
                'calories' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                calories: $input
            )
        ];

        yield 'total fat' => [
            'input' => [
                'totalFat' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                totalFat: $input
            )
        ];

        yield 'saturated fat' => [
            'input' => [
                'saturatedFat' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                saturatedFat: $input
            )
        ];

        yield 'trans fat' => [
            'input' => [
                'transFat' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                transFat: $input
            )
        ];

        yield 'carbohydrates' => [
            'input' => [
                'carbohydrates' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                carbohydrates: $input
            )
        ];

        yield 'fibre' => [
            'input' => [
                'fibre' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                fibre: $input
            )
        ];

        yield 'sugars' => [
            'input' => [
                'sugars' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                sugars: $input
            )
        ];

        yield 'protein' => [
            'input' => [
                'protein' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                protein: $input
            )
        ];

        yield 'cholesterol' => [
            'input' => [
                'cholesterol' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                cholesterol: $input
            )
        ];

        yield 'sodium' => [
            'input' => [
                'sodium' => $input = uniqid(),
            ],
            'output' => new NutritionFacts(
                sodium: $input
            )
        ];

        yield 'all' => [
            'input' => [
                'calories' => $calories = uniqid(),
                'totalFat' => $totalFat = uniqid(),
                'saturatedFat' => $saturatedFat = uniqid(),
                'transFat' => $transFat = uniqid(),
                'carbohydrates' => $carbohydrates = uniqid(),
                'fibre' => $fibre = uniqid(),
                'sugars' => $sugars = uniqid(),
                'protein' => $protein = uniqid(),
                'cholesterol' => $cholesterol = uniqid(),
                'sodium' => $sodium = uniqid(),
            ],
            'output' => new NutritionFacts(
                calories: $calories,
                totalFat: $totalFat,
                saturatedFat: $saturatedFat,
                transFat: $transFat,
                carbohydrates: $carbohydrates,
                fibre: $fibre,
                sugars: $sugars,
                protein: $protein,
                cholesterol: $cholesterol,
                sodium: $sodium
            )
        ];

        yield 'all with extra' => [
            'input' => [
                'calories' => $calories = uniqid(),
                'totalFat' => $totalFat = uniqid(),
                'saturatedFat' => $saturatedFat = uniqid(),
                'transFat' => $transFat = uniqid(),
                'carbohydrates' => $carbohydrates = uniqid(),
                'fibre' => $fibre = uniqid(),
                'sugars' => $sugars = uniqid(),
                'protein' => $protein = uniqid(),
                'cholesterol' => $cholesterol = uniqid(),
                'sodium' => $sodium = uniqid(),
                uniqid() => uniqid(),
                uniqid() => uniqid(),
            ],
            'output' => new NutritionFacts(
                calories: $calories,
                totalFat: $totalFat,
                saturatedFat: $saturatedFat,
                transFat: $transFat,
                carbohydrates: $carbohydrates,
                fibre: $fibre,
                sugars: $sugars,
                protein: $protein,
                cholesterol: $cholesterol,
                sodium: $sodium,
            )
        ];
    }
}
