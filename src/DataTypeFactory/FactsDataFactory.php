<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataTypeFactory;

use FreshAdvance\NutritionFacts\DataType\FactsData;
use FreshAdvance\NutritionFacts\DataType\FactsDataInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;

class FactsDataFactory implements FactsDataFactoryInterface
{
    public function getFromProductFacts(ProductFactsInterface $productFacts): FactsDataInterface
    {
        $nutritionFacts = $productFacts->getNutritionFacts();
        $measurement = $productFacts->getMeasurement();

        return new FactsData(
            measurementFormat: $measurement->getFormat(),
            measurementValues: $measurement->getValues(),
            nutritionFactsData: [
                'calories' => $nutritionFacts->getCalories(),
                'totalFat' => $nutritionFacts->getTotalFat(),
                'saturatedFat' => $nutritionFacts->getSaturatedFat(),
                'transFat' => $nutritionFacts->getTransFat(),
                'carbohydrates' => $nutritionFacts->getCarbohydrates(),
                'fibre' => $nutritionFacts->getFibre(),
                'sugars' => $nutritionFacts->getSugars(),
                'protein' => $nutritionFacts->getProtein(),
                'cholesterol' => $nutritionFacts->getCholesterol(),
                'sodium' => $nutritionFacts->getSodium(),
            ]
        );
    }
}
