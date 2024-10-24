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
            "SELECT * FROM fa_nutrition_facts WHERE product_id = :productId",
            ['productId' => $productId]
        );

        /** @var array<string, string|null>|null $returnResult */
        $returnResult = $result->fetchAssociative();

        /** @var array<string, string> $decodedResult */
        $decodedResult = $returnResult ? json_decode($returnResult['nutrition_facts'], true) : [];

        return new FactsData(
            measurementFormat: (string)$returnResult['measurement_format'],
            measurementValues: (string)$returnResult['measurement_values'],
            nutritionFactsData: $decodedResult,
        );
    }

    public function saveFactsData(string $productId, FactsDataInterface $factsData): bool
    {
        $encodedFacts = json_encode($factsData->getNutritionFactsData());

        $this->connection->executeQuery(
            "INSERT INTO fa_nutrition_facts (product_id, measurement_format, measurement_values, nutrition_facts)
            VALUES (:product_id, :measurement_format, :measurement_values, :nutrition_facts)
            ON DUPLICATE KEY UPDATE 
                measurement_format = VALUES(measurement_format),
                measurement_values = VALUES(measurement_values),
                nutrition_facts = VALUES(nutrition_facts);",
            [
                'product_id' => $productId,
                'measurement_format' => $factsData->getMeasurementFormat(),
                'measurement_values' => $factsData->getMeasurementValues(),
                'nutrition_facts' => $encodedFacts,
            ]
        );

        return true;
    }
}
