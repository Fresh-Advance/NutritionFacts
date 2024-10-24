<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

class FactsData implements FactsDataInterface
{
    /**
     * @param array<string, string> $nutritionFactsData
     */
    public function __construct(
        private string $measurementFormat = '',
        private string $measurementValues = '',
        private array $nutritionFactsData = []
    ) {
    }

    public function getNutritionFactsData(): array
    {
        return $this->nutritionFactsData;
    }

    public function getMeasurementFormat(): string
    {
        return $this->measurementFormat;
    }

    public function getMeasurementValues(): string
    {
        return $this->measurementValues;
    }
}
