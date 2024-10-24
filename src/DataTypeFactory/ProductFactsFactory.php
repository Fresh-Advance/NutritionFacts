<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataTypeFactory;

use FreshAdvance\NutritionFacts\Admin\Transput\EditRequestInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFacts;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;

class ProductFactsFactory implements ProductFactsFactoryInterface
{
    public function __construct(
        protected EditRequestInterface $editRequest
    ) {
    }

    public function getFromRequest(): ProductFactsInterface
    {
        return new ProductFacts(
            title: '',
            nutritionFacts: $this->editRequest->getNutritionFacts(),
            measurement: $this->editRequest->getMeasurement(),
        );
    }
}
