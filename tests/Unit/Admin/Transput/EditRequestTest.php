<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Admin\Transput;

use FreshAdvance\NutritionFacts\Admin\Exception\InvalidRequestParameterException;
use FreshAdvance\NutritionFacts\Admin\Transput\EditRequest;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\NutritionFactsFactoryInterface;
use OxidEsales\Eshop\Core\Request;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EditRequestTest extends TestCase
{
    public function testGetProductId(): void
    {
        $exampleProductId = uniqid();
        $requestStub = $this->createStub(Request::class);
        $requestStub->method('getRequestParameter')
            ->with(EditRequest::REQUEST_KEY_PRODUCT_ID)
            ->willReturn($exampleProductId);

        $sut = new EditRequest(
            shopRequest: $requestStub,
            nutritionFactsFactory: $this->createStub(NutritionFactsFactoryInterface::class)
        );

        $this->assertSame($exampleProductId, $sut->getProductId());
    }

    #[DataProvider('wrongProductIdValuesDataProvider')]
    public function testGetProductIdWithWrongDataThrowsException(mixed $value): void
    {
        $requestMock = $this->createStub(Request::class);
        $requestMock->method('getRequestParameter')
            ->with(EditRequest::REQUEST_KEY_PRODUCT_ID)
            ->willReturn($value);

        $sut = new EditRequest(
            shopRequest: $requestMock,
            nutritionFactsFactory: $this->createStub(NutritionFactsFactoryInterface::class)
        );

        $this->expectException(InvalidRequestParameterException::class);
        $sut->getProductId();
    }

    public static function wrongProductIdValuesDataProvider(): \Generator
    {
        yield 'null' => [
            'value' => null
        ];

        yield 'array value' => [
            'value' => [uniqid()]
        ];
    }

    public function testGetNutritionFacts(): void
    {
        $exampleArray = [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ];

        $sut = new EditRequest(
            shopRequest: $requestMock = $this->createMock(Request::class),
            nutritionFactsFactory: $factsFactoryMock = $this->createMock(NutritionFactsFactoryInterface::class)
        );

        $requestMock->method('getRequestParameter')
            ->with(EditRequest::REQUEST_KEY_NUTRITION_FACTS)
            ->willReturn($exampleArray);

        $factsFactoryMock->method('getFromArray')
            ->with($exampleArray)
            ->willReturn($expectedFacts = $this->createStub(NutritionFactsInterface::class));

        $this->assertSame($expectedFacts, $sut->getNutritionFacts());
    }

    #[DataProvider('wrongNutritionFactsValuesDataProvider')]
    public function testGetNutritionFactsWithWrongDataThrowsException(mixed $value): void
    {
        $requestMock = $this->createStub(Request::class);
        $requestMock->method('getRequestParameter')
            ->with(EditRequest::REQUEST_KEY_NUTRITION_FACTS)
            ->willReturn($value);

        $sut = new EditRequest(
            shopRequest: $requestMock,
            nutritionFactsFactory: $this->createStub(NutritionFactsFactoryInterface::class)
        );

        $this->expectException(InvalidRequestParameterException::class);
        $sut->getNutritionFacts();
    }

    public static function wrongNutritionFactsValuesDataProvider(): \Generator
    {
        yield 'null' => [
            'value' => null
        ];

        yield 'string value' => [
            'value' => uniqid()
        ];
    }

    public function testGetMeasurement(): void
    {
        $sut = new EditRequest(
            shopRequest: $requestMock = $this->createMock(Request::class),
            nutritionFactsFactory: $this->createStub(NutritionFactsFactoryInterface::class)
        );

        $requestMock->method('getRequestParameter')
            ->willReturnMap([
                [EditRequest::REQUEST_KEY_MEASUREMENT, null, $measurementFormat = uniqid()],
                [EditRequest::REQUEST_KEY_MEASUREMENT_VALUES, null, $values = uniqid()],
                [EditRequest::REQUEST_KEY_ADDITIONAL_NOTE, null, $additionalNoteFormat = uniqid()],
                [EditRequest::REQUEST_KEY_ADDITIONAL_NOTE_VALUES, null, $additionalNoteValues = uniqid()],
            ]);

        $measurement = $sut->getMeasurement();
        $this->assertSame($measurementFormat, $measurement->getFormat());
        $this->assertSame($values, $measurement->getValues());

        $additionalNote = $sut->getAdditionalNote();
        $this->assertSame($additionalNoteFormat, $additionalNote->getFormat());
        $this->assertSame($additionalNoteValues, $additionalNote->getValues());
    }
}
