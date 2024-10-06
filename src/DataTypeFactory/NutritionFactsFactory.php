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
            calories: $this->getStringValueByKey($data, 'calories'),
            totalFat: $this->getStringValueByKey($data, 'totalFat'),
            saturatedFat: $this->getStringValueByKey($data, 'saturatedFat'),
            transFat: $this->getStringValueByKey($data, 'transFat'),
            carbohydrates: $this->getStringValueByKey($data, 'carbohydrates'),
            fibre: $this->getStringValueByKey($data, 'fibre'),
            sugars: $this->getStringValueByKey($data, 'sugars'),
            protein: $this->getStringValueByKey($data, 'protein'),
            cholesterol: $this->getStringValueByKey($data, 'cholesterol'),
            sodium: $this->getStringValueByKey($data, 'sodium'),
        );
    }

    /**
     * @param array<string, string> $data
     */
    private function getStringValueByKey(array $data, string $key): string
    {
        return isset($data[$key]) ? strval($data[$key]) : '';
    }
}
