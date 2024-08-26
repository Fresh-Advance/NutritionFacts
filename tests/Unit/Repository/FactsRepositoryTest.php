<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Repository;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface;
use FreshAdvance\NutritionFacts\Repository\FactsRepository;
use FreshAdvance\NutritionFacts\Serializer\FactsSerializerInterface;
use PHPUnit\Framework\TestCase;

/** @covers \FreshAdvance\NutritionFacts\Repository\FactsRepository */
class FactsRepositoryTest extends TestCase
{
    public function booleanResultDataProvider(): \Generator
    {
        yield ['expectedResult' => true];
        yield ['expectedResult' => false];
    }

    /** @dataProvider booleanResultDataProvider */
    public function testSaveFactsListReturns(bool $expectedResult): void
    {
        $expectedData = uniqid();
        $exampleProductId = uniqid();

        $dataAccessSpy = $this->createMock(FactsDataAccessInterface::class);
        $dataAccessSpy->expects($this->once())
            ->method('saveFactsData')
            ->with($exampleProductId, $expectedData)
            ->willReturn($expectedResult);

        $sut = $this->getSut(
            dataAccess: $dataAccessSpy,
            serializer: $serializerMock = $this->createMock(FactsSerializerInterface::class)
        );

        $nutritionsList = $this->createConfiguredMock(NutritionFactsListInterface::class, [
            'getItems' => $this->getNutritionsArrayExample()
        ]);
        $serializerMock->method('serialize')->with($nutritionsList)->willReturn($expectedData);

        $this->assertSame($expectedResult, $sut->saveFactsList($exampleProductId, $nutritionsList));
    }

    public function testGetFactsList(): void
    {
        $databaseData = uniqid();
        $exampleProductId = uniqid();

        $dataAccessMock = $this->createMock(FactsDataAccessInterface::class);
        $dataAccessMock->method('getFactsData')
            ->with($exampleProductId)
            ->willReturn($databaseData);

        $sut = $this->getSut(
            dataAccess: $dataAccessMock,
            serializer: $serializerMock = $this->createMock(FactsSerializerInterface::class)
        );

        $expectedList = $this->createStub(NutritionFactsListInterface::class);
        $serializerMock->method('unserialize')->with($databaseData)->willReturn($expectedList);

        $this->assertSame($expectedList, $sut->getFactsList($exampleProductId));
    }

    /**
     * @return FactsRepository
     */
    public function getSut(
        FactsDataAccessInterface $dataAccess = null,
        FactsSerializerInterface $serializer = null,
    ): FactsRepository
    {
        return new FactsRepository(
            dataAccess: $dataAccess ?? $this->createStub(FactsDataAccessInterface::class),
            serializer: $serializer ?? $this->createStub(FactsSerializerInterface::class)
        );
    }

    /**
     * @return array<NutritionFactsInterface>
     */
    public function getNutritionsArrayExample(): array
    {
        return [
            $this->createConfiguredMock(NutritionFactsInterface::class, [
                'getProductId' => 'productOxid1',
                'getFacts' => ['fact1' => 'value11', 'fact2' => 'value12']
            ]),
            $this->createConfiguredMock(NutritionFactsInterface::class, [
                'getProductId' => 'productOxid2',
                'getFacts' => ['fact1' => 'value21', 'fact2' => 'value22']
            ]),
        ];
    }
}