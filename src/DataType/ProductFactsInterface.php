<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataType;

interface ProductFactsInterface
{
    public function getTitle(): string;

    public function getNutritionFacts(): NutritionFactsInterface;
}