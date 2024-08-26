<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Tests\Unit\DataType;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsList;
use FreshAdvance\NutritionFacts\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NutritionFactsListTest extends TestCase
{
    public function testDataType(): void
    {
        $exampleList = [
            $this->createStub(NutritionFactsInterface::class),
            $this->createStub(NutritionFactsInterface::class),
        ];

        $sut = new NutritionFactsList($exampleList);
        $this->assertSame($exampleList, $sut->getItems());
    }

    public function testExceptionThrownOnWrongItemType(): void
    {
        $exampleList = [
            new \stdClass()
        ];

        $this->expectException(InvalidArgumentException::class);

        $sut = new NutritionFactsList($exampleList);
    }
}