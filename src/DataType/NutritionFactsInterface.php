<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataType;

interface NutritionFactsInterface
{
    public function getCalories(): float;

    public function getTotalFat(): float;

    public function getSaturatedFat(): float;

    public function getTransFat(): float;

    public function getCarbohydrates(): float;

    public function getFibre(): float;

    public function getSugars(): float;

    public function getProtein(): float;

    public function getCholesterol(): float;

    public function getSodium(): float;
}