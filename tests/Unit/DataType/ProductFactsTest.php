<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataType;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFacts;
use PHPUnit\Framework\TestCase;

class ProductFactsTest extends TestCase
{
    public function testGetters(): void
    {
        $sut = new ProductFacts(
            title: $title = uniqid(),
            nutritionFacts: $nutritionFacts = $this->createStub(NutritionFactsInterface::class),
        );

        $this->assertSame($title, $sut->getTitle());
        $this->assertSame($nutritionFacts, $sut->getNutritionFacts());
    }
}