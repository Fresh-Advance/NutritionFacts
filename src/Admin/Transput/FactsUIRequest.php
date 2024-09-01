<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Transput;

use FreshAdvance\NutritionFacts\Admin\Exception\MissingRequestParameter;
use OxidEsales\Eshop\Core\Request;

class FactsUIRequest implements FactsUIRequestInterface
{
    public const REQUEST_KEY_PRODUCT_ID = 'oxid';

    public function __construct(
        protected Request $shopRequest
    ) {
    }

    public function getProductId(): string
    {
        return $this->getParamOrExplode(self::REQUEST_KEY_PRODUCT_ID);
    }

    protected function getParamOrExplode(string $paramName): string
    {
        /** @var null|array|string $value */
        $value = $this->shopRequest->getRequestParameter($paramName);

        if (!is_string($value)) {
            throw new MissingRequestParameter();
        }

        return $value;
    }
}
