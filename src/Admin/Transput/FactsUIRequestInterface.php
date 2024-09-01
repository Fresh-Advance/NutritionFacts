<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Transput;

use FreshAdvance\NutritionFacts\Admin\Exception\MissingRequestParameter;

/**
 * @throws MissingRequestParameter
 */
interface FactsUIRequestInterface
{
    public function getProductId(): string;
}
