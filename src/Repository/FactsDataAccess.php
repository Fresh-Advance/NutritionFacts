<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Repository;

use Doctrine\DBAL\Connection;

class FactsDataAccess implements FactsDataAccessInterface
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function getFactsData(string $productId): string
    {
        $result = $this->connection->executeQuery(
            "SELECT nutrition_facts FROM fa_nutrition_facts WHERE product_id = :productId",
            ['productId' => $productId]
        );

        return (string)$result->fetchOne();
    }

    public function saveFactsData(string $productId, string $factsList): bool
    {
        $this->connection->executeQuery(
            "INSERT INTO fa_nutrition_facts (product_id, nutrition_facts)
            VALUES (:product_id, :nutrition_facts)
            ON DUPLICATE KEY UPDATE nutrition_facts = VALUES(nutrition_facts);",
            [
                'product_id' => $productId,
                'nutrition_facts' => $factsList
            ]
        );

        return true;
    }
}