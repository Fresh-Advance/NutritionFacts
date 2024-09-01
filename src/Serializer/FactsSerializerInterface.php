<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Serializer;

use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;

interface FactsSerializerInterface
{
    public function serialize(NutritionFactsListInterface $factsList): string;

    public function unserialize(string $data): NutritionFactsListInterface;
}
