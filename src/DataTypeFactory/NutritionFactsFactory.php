<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataTypeFactory;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;

class NutritionFactsFactory implements NutritionFactsFactoryInterface
{
    public function getFromArray(array $data): NutritionFactsInterface
    {
        return new NutritionFacts(
            calories: $data['calories'] ?? 0,
            totalFat: $data['totalFat'] ?? 0,
            saturatedFat: $data['saturatedFat'] ?? 0,
            transFat: $data['transFat'] ?? 0,
            carbohydrates: $data['carbohydrates'] ?? 0,
            fibre: $data['fibre'] ?? 0,
            sugars: $data['sugars'] ?? 0,
            protein: $data['protein'] ?? 0,
            cholesterol: $data['cholesterol'] ?? 0,
            sodium: $data['sodium'] ?? 0,
        );
    }
}