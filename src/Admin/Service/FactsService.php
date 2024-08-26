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
use FreshAdvance\NutritionFacts\Serializer\FactsSerializerInterface;

class FactsService implements FactsServiceInterface
{
    protected $exampleFacts = [
        'fact1' => 'value1',
        'fact2' => 'value2',
    ];

    public function __construct(
        private FactsSerializerInterface $factsSerializer,
        private FactsRepositoryInterface $factsRepository,
    ) {
    }

    public function getProductNutritionFactsForEdit(string $productId): string
    {
        $factsList = $this->factsRepository->getFactsList($productId);

        if (empty($factsList->getItems())) {
            $factsList = new NutritionFactsList(['example' => new NutritionFacts($productId, $this->exampleFacts)]);
        }

        return $this->factsSerializer->serialize($factsList);
    }

    public function saveNutritionFactsFromRequest(string $productId, string $facts): void
    {
        $factsList = $this->factsSerializer->unserialize($facts);

        $this->factsRepository->saveFactsList($productId, $factsList);
    }
}