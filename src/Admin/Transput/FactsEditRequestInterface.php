<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

namespace FreshAdvance\NutritionFacts\Admin\Transput;

interface FactsEditRequestInterface extends FactsUIRequestInterface
{
    public function getFactsToSave(): string;
}