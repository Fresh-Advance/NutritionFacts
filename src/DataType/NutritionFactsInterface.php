<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataType;

interface NutritionFactsInterface
{
    public function getProductId(): string;

    /**
     * @return array<string, string>
     */
    public function getFacts(): array;
}