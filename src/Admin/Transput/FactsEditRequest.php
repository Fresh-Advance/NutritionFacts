<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Transput;

class FactsEditRequest extends FactsUIRequest implements FactsEditRequestInterface
{
    public const REQUEST_KEY_FACTS_TO_SAVE = 'facts';

    public function getFactsToSave(): string
    {
        return $this->getParamOrExplode(self::REQUEST_KEY_FACTS_TO_SAVE);
    }
}