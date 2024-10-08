<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Twig\Extension;

use FreshAdvance\NutritionFacts\DataType\ProductFactsInterface;
use FreshAdvance\NutritionFacts\Service\FactsServiceInterface;
use Twig\TwigFunction;

class ProductFactsExtension extends \Twig\Extension\AbstractExtension
{
    public function __construct(
        protected FactsServiceInterface $factsService
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('faGetProductFacts', [$this, 'getProductFacts'])
        ];
    }

    public function getProductFacts(string $productId): ProductFactsInterface
    {
        return $this->factsService->getProductFacts($productId);
    }
}
