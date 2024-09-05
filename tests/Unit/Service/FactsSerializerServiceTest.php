<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Serializer;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Exception\UnserializeException;
use FreshAdvance\NutritionFacts\Service\FactsSerializerService;
use PHPUnit\Framework\TestCase;

class FactsSerializerServiceTest extends TestCase
{
    public function testSerialize(): void
    {
        $listExample = $this->getListExample();
        $expectedResult = $this->getSerializedExample();

        $sut = new FactsSerializerService();
        $this->assertSame($expectedResult, $sut->serialize($listExample));
    }

    public function testUnserlizalize(): void
    {
        $sut = new FactsSerializerService();

        $unserialized = $sut->unserialize($this->getSerializedExample());
        $items = $unserialized->getItems();

        $this->assertSame("product1", $items['key1']->getProductId());
        $this->assertSame(['fact11' => 'value11', 'fact12' => 'value12'], $items['key1']->getFacts());

        $this->assertSame("product2", $items['key2']->getProductId());
        $this->assertSame(['fact21' => 'value21', 'fact22' => 'value22'], $items['key2']->getFacts());
    }

    private function getSerializedExample(): string
    {
        return file_get_contents(__DIR__ . '/../../fixtures/examples/factsYamlExample.txt');
    }

    private function getListExample(): NutritionFactsListInterface
    {
        return $this->createConfiguredMock(NutritionFactsListInterface::class, [
            'getItems' => [
                'key1' => $this->createConfiguredMock(NutritionFactsInterface::class, [
                    'getProductId' => 'product1',
                    'getFacts' => ['fact11' => 'value11', 'fact12' => 'value12']
                ]),
                'key2' => $this->createConfiguredMock(NutritionFactsInterface::class, [
                    'getProductId' => 'product2',
                    'getFacts' => ['fact21' => 'value21', 'fact22' => 'value22']
                ])
            ]
        ]);
    }

    public function testUnserializeOfEmptyString(): void
    {
        $sut = new FactsSerializerService();

        $unserialized = $sut->unserialize('');

        $this->assertSame([], $unserialized->getItems());
    }

    public function testUnserializeOfBadData(): void
    {
        $sut = new FactsSerializerService();

        $this->expectException(UnserializeException::class);
        $sut->unserialize("xx\nbla\n  -\n[]");
    }

    public function testUnserializeOfStringGivesEmptyArrayOfItems(): void
    {
        $sut = new FactsSerializerService();

        $unserialized = $sut->unserialize("someString");

        $this->assertSame([], $unserialized->getItems());
    }

    public function testUnserializeOfWronglyConfiguredArray(): void
    {
        $sut = new FactsSerializerService();

        $unserialized = $sut->unserialize("someArrayKeyExample:");

        $items = $unserialized->getItems();

        $item = $items['someArrayKeyExample'];

        $this->assertInstanceOf(NutritionFactsInterface::class, $item);
        $this->assertSame('', $item->getProductId());
        $this->assertSame([], $item->getFacts());
    }
}
