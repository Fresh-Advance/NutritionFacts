<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

class NutritionFacts implements NutritionFactsInterface
{
    public function __construct(
        private float $calories = 0,
        private float $totalFat = 0,
        private float $saturatedFat = 0,
        private float $transFat = 0,
        private float $carbohydrates = 0,
        private float $fibre = 0,
        private float $sugars = 0,
        private float $protein = 0,
        private float $cholesterol = 0,
        private float $sodium = 0,
    ) {
    }

    public function getCalories(): float
    {
        return $this->calories;
    }

    public function getTotalFat(): float
    {
        return $this->totalFat;
    }

    public function getSaturatedFat(): float
    {
        return $this->saturatedFat;
    }

    public function getTransFat(): float
    {
        return $this->transFat;
    }

    public function getCarbohydrates(): float
    {
        return $this->carbohydrates;
    }

    public function getFibre(): float
    {
        return $this->fibre;
    }

    public function getSugars(): float
    {
        return $this->sugars;
    }

    public function getProtein(): float
    {
        return $this->protein;
    }

    public function getCholesterol(): float
    {
        return $this->cholesterol;
    }

    public function getSodium(): float
    {
        return $this->sodium;
    }
}