<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Twig\Extension;

use FreshAdvance\NutritionFacts\Repository\FactsRepositoryInterface;
use Twig\TwigFunction;

class FactsExtension extends \Twig\Extension\AbstractExtension
{
    public function __construct(
        protected FactsRepositoryInterface $factsRepository,
    )
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('faGetNutritionFacts', [$this, 'getNutritionFacts'])
        ];
    }

    public function getNutritionFacts(string $productId): array
    {
        $factsList = $this->factsRepository->getFactsList($productId);
        return $factsList->getItems();
    }
}