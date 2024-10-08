<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Integration;

use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

class ServiceAvailabilityTest extends IntegrationTestCase
{
    /** @dataProvider serviceAvailabilityDataProvider */
    public function testServiceAvailability(string $serviceName): void
    {
        $service = $this->get($serviceName);
        $this->assertInstanceOf($serviceName, $service);
    }

    public function serviceAvailabilityDataProvider(): array
    {
        return [
            [\FreshAdvance\NutritionFacts\Admin\Transput\EditRequestInterface::class],
            [\FreshAdvance\NutritionFacts\DataTypeFactory\FactsDataFactoryInterface::class],
            [\FreshAdvance\NutritionFacts\DataTypeFactory\NutritionFactsFactoryInterface::class],
            [\FreshAdvance\NutritionFacts\DataTypeFactory\ProductFactsFactoryInterface::class],
            [\FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface::class],
            [\FreshAdvance\NutritionFacts\Service\FactsServiceInterface::class],
            [\FreshAdvance\NutritionFacts\Twig\Extension\ProductFactsExtension::class],
        ];
    }
}
