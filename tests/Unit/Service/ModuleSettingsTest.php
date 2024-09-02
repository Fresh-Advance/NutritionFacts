<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Settings;

use FreshAdvance\NutritionFacts\Service\ModuleSettingsService;
use FreshAdvance\NutritionFacts\Service\ModuleSettingsServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use PHPUnit\Framework\TestCase;

class ModuleSettingsTest extends TestCase
{
    public function testGetDefaultFactsReturnsCorrectSettingValue(): void
    {
        $expectedValue = ['example'];
        $shopModuleSettingsServiceStub = $this->createMock(ModuleSettingServiceInterface::class);
        $shopModuleSettingsServiceStub->method('getCollection')->willReturnMap([
            [
                ModuleSettingsServiceInterface::SETTING_DEFAULT_FACTS,
                ModuleSettingsServiceInterface::MODULE_ID,
                $expectedValue
            ]
        ]);

        $sut = new ModuleSettingsService(
            shopModuleSettingService: $shopModuleSettingsServiceStub
        );

        $this->assertSame($expectedValue, $sut->getDefaultFacts());
    }
}
