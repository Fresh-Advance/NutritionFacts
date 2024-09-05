<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Service;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsList;
use FreshAdvance\NutritionFacts\Repository\FactsRepositoryInterface;
use FreshAdvance\NutritionFacts\Service\FactsSerializerServiceInterface;
use FreshAdvance\NutritionFacts\Service\ModuleSettingsServiceInterface;

class FactsService implements FactsServiceInterface
{
    public function __construct(
        private FactsSerializerServiceInterface $factsSerializer,
        private FactsRepositoryInterface $factsRepository,
        private ModuleSettingsServiceInterface $moduleSettingsService,
    ) {
    }

    public function getProductNutritionFactsForEdit(string $productId): string
    {
        $factsList = $this->factsRepository->getFactsList($productId);

        if (empty($factsList->getItems())) {
            $factsList = new NutritionFactsList([
                'example' => new NutritionFacts(
                    productId: $productId,
                    facts: $this->moduleSettingsService->getDefaultFacts()
                )
            ]);
        }

        return $this->factsSerializer->serialize($factsList);
    }

    public function saveNutritionFactsFromRequest(string $productId, string $facts): void
    {
        $factsList = $this->factsSerializer->unserialize($facts);

        $this->factsRepository->saveFactsList($productId, $factsList);
    }
}
