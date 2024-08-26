<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

class NutritionFacts implements NutritionFactsInterface
{
    public function __construct(
        protected string $productId,
        protected array $facts
    ) {
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getFacts(): array
    {
        return $this->facts;
    }
}