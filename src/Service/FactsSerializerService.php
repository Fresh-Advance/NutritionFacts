<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Service;

use FreshAdvance\NutritionFacts\DataType\NutritionFacts;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsList;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsListInterface;
use FreshAdvance\NutritionFacts\Exception\UnserializeException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class FactsSerializerService implements FactsSerializerServiceInterface
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

        return Yaml::dump($result, 10, 2);
    }

    public function unserialize(string $data): NutritionFactsListInterface
    {
        try {
            /** @var iterable $decoded */
            $decoded = Yaml::parse($data);
        } catch (ParseException $exception) {
            throw new UnserializeException($exception->getMessage());
        }

        $items = [];
        foreach ($decoded as $key => $oneItem) {
            $items[$key] = new NutritionFacts(
                productId: $oneItem['product'] ?? '',
                facts: $oneItem['facts'] && is_array($oneItem['facts']) ? $oneItem['facts'] : []
            );
        }

        return new NutritionFactsList($items);
    }
}
