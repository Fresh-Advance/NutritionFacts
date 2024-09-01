<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataType;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use PHPUnit\Framework\TestCase;

class NutritionFactsTest extends TestCase
{
    public function testDataType(): void
    {
        $productId = uniqid();
        $facts = [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ];

        $sut = new NutritionFacts($productId, $facts);

        $this->assertSame($productId, $sut->getProductId());
        $this->assertSame($facts, $sut->getFacts());
    }
}
