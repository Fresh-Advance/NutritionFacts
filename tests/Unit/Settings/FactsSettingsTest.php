<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Tests\Unit\Settings;

use FreshAdvance\NutritionFacts\Module;
use FreshAdvance\NutritionFacts\Settings\FactsSettings;
use FreshAdvance\NutritionFacts\Settings\FactsSettingsInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use PHPUnit\Framework\TestCase;

class FactsSettingsTest extends TestCase
{
    public function testGetMeasurementOptions(): void
    {
        $sut = $this->getSut(
            moduleSettingService: $settingsServiceMock = $this->createMock(ModuleSettingServiceInterface::class),
        );

        $settingsServiceMock->method('getCollection')
            ->with(FactsSettings::SETTING_MEASUREMENT_OPTIONS, Module::MODULE_ID)
            ->willReturn($expected = [uniqid() => uniqid()]);

        $this->assertSame($expected, $sut->getMeasurementOptions());
    }

    public function getSut(
        ModuleSettingServiceInterface $moduleSettingService = null,
    ): FactsSettingsInterface
    {
        return new FactsSettings(
            moduleSettingService: $moduleSettingService ?? $this->createMock(ModuleSettingServiceInterface::class),
        );
    }
}