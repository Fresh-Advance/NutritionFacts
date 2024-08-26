<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Serializer;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsList;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;

class JsonSerializer implements FactsSerializerInterface
{
    public function serialize(NutritionFactsListInterface $factsList): string
    {
        $result = [];
        foreach ($factsList->getItems() as $key => $oneItem) {
            $result[$key] = [
                'product' => $oneItem->getProductId(),
                'facts' => $oneItem->getFacts(),
            ];
        }

        return json_encode($result);
    }

    public function unserialize(string $data): NutritionFactsListInterface
    {
        $decoded = json_decode($data, true);

        $items = [];
        foreach ($decoded as $key => $oneItem) {
            $items[$key] = new NutritionFacts($oneItem['product'], $oneItem['facts']);
        }

        return new NutritionFactsList($items);
    }
}