<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Repository;

interface FactsDataAccessInterface
{
    public function getFactsData(string $productId): string;

    public function saveFactsData(string $productId, string $factsList): bool;
}
