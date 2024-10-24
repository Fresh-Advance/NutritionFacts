<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Transput;

use FreshAdvance\NutritionFacts\Admin\Exception\InvalidRequestParameterException;
use FreshAdvance\NutritionFacts\DataType\Measurement;
use FreshAdvance\NutritionFacts\DataType\MeasurementInterface;
use FreshAdvance\NutritionFacts\DataType\NutritionFactsInterface;
use FreshAdvance\NutritionFacts\DataTypeFactory\NutritionFactsFactoryInterface;
use OxidEsales\Eshop\Core\Request;

use function is_string;

class EditRequest implements EditRequestInterface
{
    public const REQUEST_KEY_PRODUCT_ID = 'oxid';
    public const REQUEST_KEY_NUTRITION_FACTS = 'nutritionFacts';

    public const REQUEST_KEY_MEASUREMENT = 'measurement';
    public const REQUEST_KEY_MEASUREMENT_VALUES = 'measurementValues';

    public function __construct(
        protected Request $shopRequest,
        protected NutritionFactsFactoryInterface $nutritionFactsFactory,
    ) {
    }

    public function getProductId(): string
    {
        /** @var null|array<string,string>|string $value */
        $value = $this->shopRequest->getRequestParameter(self::REQUEST_KEY_PRODUCT_ID);

        if (!is_string($value)) {
            throw new InvalidRequestParameterException(self::REQUEST_KEY_PRODUCT_ID);
        }

        return $value;
    }

    public function getNutritionFacts(): NutritionFactsInterface
    {
        /** @var null|array<string,string>|string $value */
        $value = $this->shopRequest->getRequestParameter(self::REQUEST_KEY_NUTRITION_FACTS);

        if (!is_array($value)) {
            throw new InvalidRequestParameterException(self::REQUEST_KEY_NUTRITION_FACTS);
        }

        return $this->nutritionFactsFactory->getFromArray($value);
    }

    public function getMeasurement(): MeasurementInterface
    {
        return new Measurement(
            format: $this->shopRequest->getRequestParameter(self::REQUEST_KEY_MEASUREMENT),
            values: $this->shopRequest->getRequestParameter(self::REQUEST_KEY_MEASUREMENT_VALUES),
        );
    }
}
