<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Settings;

use FreshAdvance\NutritionFacts\Module;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;

class FactsSettings implements FactsSettingsInterface
{
    public const SETTING_MEASUREMENT_OPTIONS = 'fa_nutrition_facts_MeasurementOptions';
    public const SETTING_MEASUREMENT_OPTIONS_PARAMS = 'fa_nutrition_facts_MeasurementOptions';

    public function __construct(
        private ModuleSettingServiceInterface $moduleSettingService
    ) {
    }

    public function getMeasurementOptions(): array
    {
        return $this->moduleSettingService->getCollection(
            self::SETTING_MEASUREMENT_OPTIONS,
            Module::MODULE_ID
        );
    }
}
