<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\DataType;

class ValuesFormatPair implements ValuesFormatPairInterface
{
    public function __construct(
        protected string $format,
        protected string $values
    ) {
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getValues(): string
    {
        return $this->values;
    }
}
