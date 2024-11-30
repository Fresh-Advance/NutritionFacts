<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataType;

interface FactsDataInterface
{
    /**
     * @return array<string, string>
     */
    public function getNutritionFactsData(): array;

    public function getMeasurementFormat(): string;

    public function getMeasurementValues(): string;

    public function getAdditionalFormat(): string;

    public function getAdditionalValues(): string;
}
