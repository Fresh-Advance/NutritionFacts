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
use FreshAdvance\NutritionFacts\Exception\UnserializeException;

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

        return (string)json_encode($result);
    }

    public function unserialize(string $data): NutritionFactsListInterface
    {
        try {
            /** @var iterable $decoded */
            $decoded = $data ? json_decode(
                json: $data,
                associative: true,
                flags: JSON_THROW_ON_ERROR
            ) : [];
        } catch (\JsonException $exception) {
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
