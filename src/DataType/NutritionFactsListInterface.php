<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataType;

interface NutritionFactsListInterface
{
    /**
     * @return array<NutritionFactsInterface>
     */
    public function getItems(): array;
}