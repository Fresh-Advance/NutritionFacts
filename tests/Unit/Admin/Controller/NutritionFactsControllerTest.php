<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Unit\Admin\Controller;

use FreshAdvance\NutritionFacts\Admin\Controller\NutritionFactsController;
use FreshAdvance\NutritionFacts\Admin\Service\FactsServiceInterface as AdminFactsServiceInterface;
use FreshAdvance\NutritionFacts\Admin\Transput\FactsEditRequestInterface;
use FreshAdvance\NutritionFacts\Admin\Transput\FactsUIRequestInterface;
use PHPUnit\Framework\TestCase;

class NutritionFactsControllerTest extends TestCase
{
    public function testRenderSetsRequiredTemplateVariables(): void
    {
        $productId = uniqid();
        $nutritionFactsForTextArea = uniqid();

        $factsServiceMock = $this->createMock(AdminFactsServiceInterface::class);
        $factsServiceMock->method('getProductNutritionFactsForEdit')
            ->with($productId)->willReturn($nutritionFactsForTextArea);

        $uiRequestStub = $this->createConfiguredMock(FactsUIRequestInterface::class, [
            'getProductId' => $productId,
        ]);

        $sut = $this->createPartialMock(NutritionFactsController::class, ['getServiceFromContainer']);
        $sut->method('getServiceFromContainer')->willReturnMap([
            [AdminFactsServiceInterface::class, $factsServiceMock],
            [FactsUIRequestInterface::class, $uiRequestStub],
        ]);

        $sut->render();

        $viewParams = $sut->getViewData();
        $this->assertSame($viewParams['nutrition_facts'], $nutritionFactsForTextArea);
    }

    public function testSaveMethodTriggersDataUpdate(): void
    {
        $editRequestStub = $this->createConfiguredMock(FactsEditRequestInterface::class, [
            'getProductId' => $productId = uniqid(),
            'getFactsToSave' => $factsToSave = uniqid(),
        ]);

        $factsServiceSpy = $this->createMock(AdminFactsServiceInterface::class);
        $factsServiceSpy->expects($this->once())->method('saveNutritionFactsFromRequest')
            ->with($productId, $factsToSave);

        $sut = $this->createPartialMock(NutritionFactsController::class, ['getServiceFromContainer']);
        $sut->method('getServiceFromContainer')->willReturnMap([
            [AdminFactsServiceInterface::class, $factsServiceSpy],
            [FactsEditRequestInterface::class, $editRequestStub]
        ]);

        $sut->saveData();
    }
}
