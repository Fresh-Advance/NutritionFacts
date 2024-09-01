<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Repository;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;

interface FactsRepositoryInterface
{
    public function getFactsList(string $productId): NutritionFactsListInterface;

    public function saveFactsList(string $productId, NutritionFactsListInterface $factsList): bool;
}
