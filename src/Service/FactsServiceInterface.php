<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;

interface FactsServiceInterface
{
    public function getProductNutritionFacts(string $productId): NutritionFactsListInterface;
}
