<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;

class ModuleSettingsService implements ModuleSettingsServiceInterface
{
    public function __construct(
        private ModuleSettingServiceInterface $shopModuleSettingService
    ) {
    }

    public function getDefaultFacts(): array
    {
        return $this->shopModuleSettingService->getCollection(
            ModuleSettingsServiceInterface::SETTING_DEFAULT_FACTS,
            ModuleSettingsServiceInterface::MODULE_ID
        );
    }
}
