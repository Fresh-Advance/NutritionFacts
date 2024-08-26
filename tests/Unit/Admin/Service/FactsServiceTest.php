<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Admin\Service;

use FreshAdvance\NutritionFacts\Admin\Service\FactsService;
use FreshAdvance\NutritionFacts\Admin\Service\FactsServiceInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsList;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Repository\FactsRepositoryInterface;
use FreshAdvance\NutritionFacts\Serializer\FactsSerializerInterface;
use PHPUnit\Framework\TestCase;

class FactsServiceTest extends TestCase
{
    public function testGetProductNutritionFactsForEditReturnsDecodedYaml(): void
    {
        $productId = uniqid();

        $sut = $this->getSut(
            factsSerializer: $factsSerializer = $this->createMock(FactsSerializerInterface::class),
            factsRepository: $factsRepository = $this->createMock(FactsRepositoryInterface::class),
        );

        $factsListStub = $this->createStub(NutritionFactsListInterface::class);
        $factsListStub->method('getItems')->willReturn([
            $this->createStub(NutritionFactsInterface::class),
        ]);

        $factsRepository->method('getFactsList')->with($productId)->willReturn($factsListStub);

        $serializedFacts = uniqid();
        $factsSerializer->method('serialize')->with($factsListStub)->willReturn($serializedFacts);

        $this->assertSame($serializedFacts, $sut->getProductNutritionFactsForEdit($productId));
    }

    public function testGetProductNutritionFactsForEditReturnsPreconfiguredYamlIfThereIsNoConfiguration(): void
    {
        $productId = uniqid();

        $sut = $this->getSut(
            factsSerializer: $factsSerializerSpy = $this->createMock(FactsSerializerInterface::class),
            factsRepository: $factsRepository = $this->createMock(FactsRepositoryInterface::class),
        );

        $factsRepository->method('getFactsList')->with($productId)->willReturn(
            $this->createConfiguredMock(NutritionFactsListInterface::class, [
                'getItems' => []
            ])
        );

        $serializedReturn = uniqid();
        $factsSerializerSpy->expects($this->once())
            ->method('serialize')
            ->willReturnCallback(function ($factsList) use ($productId, $serializedReturn) {
                /** @var NutritionFactsInterface $item */
                $item = $factsList->getItems()['example'];
                $this->assertSame($item->getProductId(), $productId);
                $this->assertNotEmpty($item->getFacts());

                return $serializedReturn;
            });

        $this->assertSame($serializedReturn, $sut->getProductNutritionFactsForEdit($productId));
    }

    public function testSaveNutritionFactsFromRequestUnserializesStringAndSaves(): void
    {
        $productId = uniqid();
        $serializedFacts = uniqid();

        $sut = $this->getSut(
            factsSerializer: $factsSerializer = $this->createMock(FactsSerializerInterface::class),
            factsRepository: $factsRepository = $this->createMock(FactsRepositoryInterface::class),
        );

        $factsListStub = $this->createStub(NutritionFactsListInterface::class);
        $factsSerializer->method('unserialize')->with($serializedFacts)->willReturn($factsListStub);

        $factsRepository->expects($this->once())->method('saveFactsList')->with($productId, $factsListStub);

        $sut->saveNutritionFactsFromRequest($productId, $serializedFacts);
    }

    public function getSut(
        FactsSerializerInterface $factsSerializer = null,
        FactsRepositoryInterface $factsRepository = null,
    ): FactsServiceInterface
    {
        return new FactsService(
            factsSerializer: $factsSerializer ?? $this->createStub(FactsSerializerInterface::class),
            factsRepository: $factsRepository ?? $this->createStub(FactsRepositoryInterface::class),
        );
    }
}