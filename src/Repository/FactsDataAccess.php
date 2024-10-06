<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Repository;

use Doctrine\DBAL\Connection;
use FreshAdvance\NutritionFacts\DataType\FactsData;
use FreshAdvance\NutritionFacts\DataType\FactsDataInterface;

class FactsDataAccess implements FactsDataAccessInterface
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function getFactsData(string $productId): FactsDataInterface
    {
        $result = $this->connection->executeQuery(
            "SELECT nutrition_facts FROM fa_nutrition_facts WHERE product_id = :productId",
            ['productId' => $productId]
        );

        /** @var string|null $returnResult */
        $returnResult = $result->fetchOne();

        /** @var array<string, string> $decodedResult */
        $decodedResult = $returnResult ? json_decode($returnResult, true) : [];

        return new FactsData(
            nutritionFactsData: $decodedResult,
        );
    }

    public function saveFactsData(string $productId, FactsDataInterface $factsData): bool
    {
        $encodedFacts = json_encode($factsData->getNutritionFactsData());

        $this->connection->executeQuery(
            "INSERT INTO fa_nutrition_facts (product_id, nutrition_facts)
            VALUES (:product_id, :nutrition_facts)
            ON DUPLICATE KEY UPDATE nutrition_facts = VALUES(nutrition_facts);",
            [
                'product_id' => $productId,
                'nutrition_facts' => $encodedFacts,
            ]
        );

        return true;
    }
}
