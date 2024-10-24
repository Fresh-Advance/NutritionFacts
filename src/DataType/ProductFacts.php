<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

class ProductFacts implements ProductFactsInterface
{
    public function __construct(
        private string $title,
        private NutritionFactsInterface $nutritionFacts,
        private MeasurementInterface $measurement,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getNutritionFacts(): NutritionFactsInterface
    {
        return $this->nutritionFacts;
    }

    public function getMeasurement(): MeasurementInterface
    {
        return $this->measurement;
    }
}
