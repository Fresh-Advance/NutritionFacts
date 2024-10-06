<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Admin\Transput;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;

interface EditRequestInterface
{
    public function getProductId(): string;

    public function getNutritionFacts(): NutritionFactsInterface;
}