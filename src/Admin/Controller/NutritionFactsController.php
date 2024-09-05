<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Controller;

use FreshAdvance\NutritionFacts\Admin\Service\FactsServiceInterface;
use FreshAdvance\NutritionFacts\Admin\Transput\FactsEditRequestInterface;
use FreshAdvance\NutritionFacts\Admin\Transput\FactsUIRequestInterface;
use FreshAdvance\NutritionFacts\Traits\ServiceContainer;
use OxidEsales\Eshop\Application\Controller\Admin\AdminController;

class NutritionFactsController extends AdminController
{
    use ServiceContainer;

    protected $_sThisTemplate = '@fa_nutrition_facts/admin/nutrition_facts';

    public function render()
    {
        $uiRequest = $this->getServiceFromContainer(FactsUIRequestInterface::class);
        $adminFactsService = $this->getServiceFromContainer(FactsServiceInterface::class);

        $viewData = $this->getViewData();
        if (!$viewData['nutrition_facts']) {
            $this->addTplParam(
                'nutrition_facts',
                $adminFactsService->getProductNutritionFactsForEdit($uiRequest->getProductId())
            );
        }

        return parent::render();
    }

    public function saveData(): void
    {
        $editRequest = $this->getServiceFromContainer(FactsEditRequestInterface::class);
        $adminFactsService = $this->getServiceFromContainer(FactsServiceInterface::class);

        try {
            $adminFactsService->saveNutritionFactsFromRequest($editRequest->getProductId(), $editRequest->getFactsToSave());
        } catch (\Exception $e) {
            $this->addTplParam('error', $e->getMessage());
            $this->addTplParam(
                'nutrition_facts',
                $editRequest->getFactsToSave()
            );
        }
    }
}
