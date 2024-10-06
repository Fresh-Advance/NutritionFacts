<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

class NutritionFacts implements NutritionFactsInterface
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList) This is a data class so may have a lot of parameters.
     */
    public function __construct(
        private string $calories = '',
        private string $totalFat = '',
        private string $saturatedFat = '',
        private string $transFat = '',
        private string $carbohydrates = '',
        private string $fibre = '',
        private string $sugars = '',
        private string $protein = '',
        private string $cholesterol = '',
        private string $sodium = '',
    ) {
    }

    public function getCalories(): string
    {
        return $this->calories;
    }

    public function getTotalFat(): string
    {
        return $this->totalFat;
    }

    public function getSaturatedFat(): string
    {
        return $this->saturatedFat;
    }

    public function getTransFat(): string
    {
        return $this->transFat;
    }

    public function getCarbohydrates(): string
    {
        return $this->carbohydrates;
    }

    public function getFibre(): string
    {
        return $this->fibre;
    }

    public function getSugars(): string
    {
        return $this->sugars;
    }

    public function getProtein(): string
    {
        return $this->protein;
    }

    public function getCholesterol(): string
    {
        return $this->cholesterol;
    }

    public function getSodium(): string
    {
        return $this->sodium;
    }
}
