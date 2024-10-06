<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\DataType;

interface NutritionFactsInterface
{
    public function getCalories(): string;

    public function getTotalFat(): string;

    public function getSaturatedFat(): string;

    public function getTransFat(): string;

    public function getCarbohydrates(): string;

    public function getFibre(): string;

    public function getSugars(): string;

    public function getProtein(): string;

    public function getCholesterol(): string;

    public function getSodium(): string;
}
