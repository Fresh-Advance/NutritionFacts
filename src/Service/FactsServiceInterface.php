<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;

interface FactsServiceInterface
{
    public function getProductFacts(string $productId): ProductFactsInterface;

    public function saveProductFacts(string $productId, ProductFactsInterface $productFacts): void;
}
