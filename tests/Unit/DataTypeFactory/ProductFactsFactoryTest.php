<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataTypeFactory;

use FreshAdvance\NutritionFacts\Admin\Transput\EditRequestInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\ProductFactsFactory;
use PHPUnit\Framework\TestCase;

class ProductFactsFactoryTest extends TestCase
{
    public function testGetFromRequest(): void
    {
        $editRequestStub = $this->createConfiguredMock(EditRequestInterface::class, [
            'getNutritionFacts' => $nutritionFacts = $this->createStub(NutritionFactsInterface::class),
        ]);

        $sut = new ProductFactsFactory(
            editRequest: $editRequestStub
        );

        $productFacts = $sut->getFromRequest();

        $this->assertSame($nutritionFacts, $productFacts->getNutritionFacts());
    }
}
