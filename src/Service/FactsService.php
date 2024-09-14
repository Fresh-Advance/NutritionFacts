<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Repository\FactsRepositoryInterface;

class FactsService implements FactsServiceInterface
{
    public function __construct(
        protected FactsRepositoryInterface $factsRepository
    ) {
    }

    public function getProductNutritionFacts(string $productId): NutritionFactsListInterface
    {
        return $this->factsRepository->getFactsList($productId);
    }
}