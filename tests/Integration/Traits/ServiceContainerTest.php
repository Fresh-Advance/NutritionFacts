<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Integration\Traits;

use FreshAdvance\NutritionFacts\Admin\Service\FactsServiceInterface;
use FreshAdvance\NutritionFacts\Traits\ServiceContainer;
use FreshAdvance\NutritionFacts\Service\SettingsServiceInterface;
use OxidEsales\Eshop\Core\Registry;
use PHPUnit\Framework\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testGetServiceFromContainer()
    {
        $sut = new class {
            use ServiceContainer;

            public function getTestService(string $service)
            {
                return $this->getServiceFromContainer($service);
            }
        };

        $this->assertInstanceOf(
            Registry::class,
            $sut->getTestService('FreshAdvance\NutritionFacts\Core\Registry')
        );
    }
}
