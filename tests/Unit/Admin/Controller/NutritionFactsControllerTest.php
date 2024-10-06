<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Admin\Controller;

use FreshAdvance\NutritionFacts\Admin\Controller\NutritionFactsController;
use FreshAdvance\NutritionFacts\Admin\Transput\EditRequestInterface;
use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\ProductFactsFactoryInterface;
use FreshAdvance\NutritionFacts\Service\FactsServiceInterface;
use PHPUnit\Framework\TestCase;

class NutritionFactsControllerTest extends TestCase
{
    public function testRender()
    {
        $productId = uniqid();

        $sut = $this->getSut(
            editRequestMock: $this->createConfiguredMock(EditRequestInterface::class, [
                'getProductId' => $productId
            ]),
            factsServiceMock: $factsServiceMock = $this->createMock(FactsServiceInterface::class),
        );

        $factsServiceMock->method('getProductFacts')->with($productId)->willReturn(
            $productFactsStub = $this->createStub(ProductFactsInterface::class)
        );

        $sut->render();

        $viewParams = $sut->getViewData();
        $this->assertSame($productFactsStub, $viewParams['productFacts']);
    }

    public function testSave()
    {
        $productId = uniqid();

        $sut = $this->getSut(
            editRequestMock: $this->createConfiguredMock(EditRequestInterface::class, [
                'getProductId' => $productId,
            ]),
            factsServiceMock: $factsServiceSpy = $this->createMock(FactsServiceInterface::class),
            productFactsFactoryMock: $factsFactoryMock = $this->createMock(ProductFactsFactoryInterface::class),
        );

        $factsFactoryMock->method('getFromRequest')->willReturn(
            $productFactsStub = $this->createStub(ProductFactsInterface::class)
        );

        $factsServiceSpy->expects($this->once())
            ->method('saveProductFacts')
            ->with($productId, $productFactsStub);

        $sut->saveData();
    }

    protected function getSut(
        EditRequestInterface $editRequestMock = null,
        FactsServiceInterface $factsServiceMock = null,
        ProductFactsFactoryInterface $productFactsFactoryMock = null,
    ): NutritionFactsController {
        $editRequestMock ??= $this->createStub(EditRequestInterface::class);
        $factsServiceMock ??= $this->createStub(FactsServiceInterface::class);
        $productFactsFactoryMock ??= $this->createStub(ProductFactsFactoryInterface::class);

        $sut = $this->createPartialMock(NutritionFactsController::class, ['getServiceFromContainer']);
        $sut->method('getServiceFromContainer')->willReturnMap([
            [EditRequestInterface::class, $editRequestMock],
            [FactsServiceInterface::class, $factsServiceMock],
            [ProductFactsFactoryInterface::class, $productFactsFactoryMock],
        ]);

        return $sut;
    }
}
