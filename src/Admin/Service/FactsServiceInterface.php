<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Service;

interface FactsServiceInterface
{
    public function getProductNutritionFactsForEdit(string $productId): string;

    public function saveNutritionFactsFromRequest(string $productId, string $facts): void;
}