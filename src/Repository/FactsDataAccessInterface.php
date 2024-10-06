<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Repository;

use FreshAdvance\NutritionFacts\DataType\FactsDataInterface;

interface FactsDataAccessInterface
{
    public function getFactsData(string $productId): FactsDataInterface;

    public function saveFactsData(string $productId, FactsDataInterface $factsData): bool;
}
