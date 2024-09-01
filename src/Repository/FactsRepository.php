<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Repository;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Serializer\FactsSerializerInterface;

class FactsRepository implements FactsRepositoryInterface
{
    public function __construct(
        private FactsDataAccessInterface $dataAccess,
        private FactsSerializerInterface $serializer,
    ) {
    }

    public function getFactsList(string $productId): NutritionFactsListInterface
    {
        $data = $this->dataAccess->getFactsData($productId);
        return $this->serializer->unserialize($data);
    }

    public function saveFactsList(string $productId, NutritionFactsListInterface $factsList): bool
    {
        $data = $this->serializer->serialize($factsList);
        return $this->dataAccess->saveFactsData($productId, $data);
    }
}
