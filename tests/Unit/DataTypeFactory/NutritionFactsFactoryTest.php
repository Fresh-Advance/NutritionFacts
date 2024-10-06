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
                'calories' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                calories: $input
            )
        ];

        yield 'total fat' => [
            'input' => [
                'totalFat' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                totalFat: $input
            )
        ];

        yield 'saturated fat' => [
            'input' => [
                'saturatedFat' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                saturatedFat: $input
            )
        ];

        yield 'trans fat' => [
            'input' => [
                'transFat' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                transFat: $input
            )
        ];

        yield 'carbohydrates' => [
            'input' => [
                'carbohydrates' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                carbohydrates: $input
            )
        ];

        yield 'fibre' => [
            'input' => [
                'fibre' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                fibre: $input
            )
        ];

        yield 'sugars' => [
            'input' => [
                'sugars' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                sugars: $input
            )
        ];

        yield 'protein' => [
            'input' => [
                'protein' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                protein: $input
            )
        ];

        yield 'cholesterol' => [
            'input' => [
                'cholesterol' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                cholesterol: $input
            )
        ];

        yield 'sodium' => [
            'input' => [
                'sodium' => $input = rand(1, 1000),
            ],
            'output' => new NutritionFacts(
                sodium: $input
            )
        ];

        yield 'all' => [
            'input' => [
                'calories' => $calories = rand(1, 1000),
                'totalFat' => $totalFat = rand(1, 1000),
                'saturatedFat' => $saturatedFat = rand(1, 1000),
                'transFat' => $transFat = rand(1, 1000),
                'carbohydrates' => $carbohydrates = rand(1, 1000),
                'fibre' => $fibre = rand(1, 1000),
                'sugars' => $sugars = rand(1, 1000),
                'protein' => $protein = rand(1, 1000),
                'cholesterol' => $cholesterol = rand(1, 1000),
                'sodium' => $sodium = rand(1, 1000),
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
                'calories' => $calories = rand(1, 1000),
                'totalFat' => $totalFat = rand(1, 1000),
                'saturatedFat' => $saturatedFat = rand(1, 1000),
                'transFat' => $transFat = rand(1, 1000),
                'carbohydrates' => $carbohydrates = rand(1, 1000),
                'fibre' => $fibre = rand(1, 1000),
                'sugars' => $sugars = rand(1, 1000),
                'protein' => $protein = rand(1, 1000),
                'cholesterol' => $cholesterol = rand(1, 1000),
                'sodium' => $sodium = rand(1, 1000),
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
                sodium: $sodium
            )
        ];
    }
}