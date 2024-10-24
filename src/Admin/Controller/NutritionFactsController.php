<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Controller;

use FreshAdvance\NutritionFacts\Admin\Transput\EditRequestInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\ProductFactsFactoryInterface;
use FreshAdvance\NutritionFacts\Service\FactsServiceInterface;
use FreshAdvance\NutritionFacts\Settings\FactsSettingsInterface;
use FreshAdvance\NutritionFacts\Traits\ServiceContainer;
use OxidEsales\Eshop\Application\Controller\Admin\AdminController;

class NutritionFactsController extends AdminController
{
    use ServiceContainer;

    protected $_sThisTemplate = '@fa_nutrition_facts/admin/nutrition_facts';

    public function render()
    {
        $editRequest = $this->getServiceFromContainer(EditRequestInterface::class);
        $factsService = $this->getServiceFromContainer(FactsServiceInterface::class);
        $factsSettings = $this->getServiceFromContainer(FactsSettingsInterface::class);

        $this->addTplParam('measurementOptions', $factsSettings->getMeasurementOptions());

        $productFacts = $factsService->getProductFacts($editRequest->getProductId());
        $this->addTplParam('nutritionFacts', $productFacts->getNutritionFacts());
        $this->addTplParam('measurement', $productFacts->getMeasurement());

        return parent::render();
    }

    public function saveData(): void
    {
        $editRequest = $this->getServiceFromContainer(EditRequestInterface::class);
        $productFactsFactory = $this->getServiceFromContainer(ProductFactsFactoryInterface::class);
        $factsService = $this->getServiceFromContainer(FactsServiceInterface::class);

        $factsService->saveProductFacts($editRequest->getProductId(), $productFactsFactory->getFromRequest());
    }
}
