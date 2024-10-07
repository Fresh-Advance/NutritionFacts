<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataTypeFactory;

use FreshAdvance\NutritionFacts\DataType\FactsDataInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;

interface FactsDataFactoryInterface
{
    public function getFromProductFacts(ProductFactsInterface $productFacts): FactsDataInterface;
}