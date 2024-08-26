<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

use FreshAdvance\NutritionFacts\Exception\InvalidArgumentException;

class NutritionFactsList implements NutritionFactsListInterface
{
    public function __construct(
        protected array $items
    ) {
        foreach ($this->items as $item) {
            if (!$item instanceof NutritionFactsInterface) {
                throw new InvalidArgumentException();
            }
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }
}