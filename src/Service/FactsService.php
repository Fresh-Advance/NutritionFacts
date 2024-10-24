<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

use FreshAdvance\NutritionFacts\DataType\Measurement;
use FreshAdvance\NutritionFacts\DataType\ProductFacts;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\FactsDataFactoryInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\NutritionFactsFactoryInterface;
use FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface;

class FactsService implements FactsServiceInterface
{
    public function __construct(
        protected FactsDataAccessInterface $factsDataAccess,
        protected NutritionFactsFactoryInterface $nutritionFactsFactory,
        protected FactsDataFactoryInterface $factsDataFactory,
    ) {
    }

    public function getProductFacts(string $productId): ProductFactsInterface
    {
        $factsData = $this->factsDataAccess->getFactsData($productId);

        return new ProductFacts(
            title: '',
            nutritionFacts: $this->nutritionFactsFactory->getFromArray($factsData->getNutritionFactsData()),
            measurement: new Measurement(
                format: $factsData->getMeasurementFormat(),
                values: $factsData->getMeasurementValues(),
            )
        );
    }

    public function saveProductFacts(string $productId, ProductFactsInterface $productFacts): void
    {
        $factsData = $this->factsDataFactory->getFromProductFacts($productFacts);

        $this->factsDataAccess->saveFactsData($productId, $factsData);
    }
}
