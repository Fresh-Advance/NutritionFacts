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
use Symfony\Component\Yaml\Yaml;

class YamlSerializer implements FactsSerializerInterface
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

        return Yaml::dump($result, 3, 2);
    }

    public function unserialize(string $data): NutritionFactsListInterface
    {
        $decoded = Yaml::parse($data);

        $items = [];
        foreach ($decoded as $key => $oneItem) {
            $items[$key] = new NutritionFacts($oneItem['product'], $oneItem['facts']);
        }

        return new NutritionFactsList($items);
    }
}