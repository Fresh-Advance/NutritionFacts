<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataType;

use FreshAdvance\NutritionFacts\DataType\ValuesFormatPair;
use PHPUnit\Framework\TestCase;

class ValuesFormatPairTest extends TestCase
{
    public function testConstructor(): void
    {
        $sut = new ValuesFormatPair(
            format: $format = uniqid(),
            values: $values = uniqid(),
        );

        $this->assertSame($format, $sut->getFormat());
        $this->assertSame($values, $sut->getValues());
    }
}
