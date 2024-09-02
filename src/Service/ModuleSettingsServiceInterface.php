<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

interface ModuleSettingsServiceInterface
{
    public const MODULE_ID = 'fa_nutrition_facts';

    public const SETTING_DEFAULT_FACTS = 'fa_nutrition_facts_defaults_list';

    /**
     * @return array<string, string>
     */
    public function getDefaultFacts(): array;
}
