<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Settings;

interface FactsSettingsInterface
{
    /**
     * @return array<string, string>
     */
    public function getMeasurementOptions(): array;
}
