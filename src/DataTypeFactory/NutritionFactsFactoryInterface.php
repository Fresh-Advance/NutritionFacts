<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataTypeFactory;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;

interface NutritionFactsFactoryInterface
{
    public function getFromArray(array $data): NutritionFactsInterface;
}