<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Transput;

use FreshAdvance\NutritionFacts\Admin\Exception\InvalidRequestParameterException;
use FreshAdvance\NutritionFacts\DataType\ValuesFormatPair;
use FreshAdvance\NutritionFacts\DataType\ValuesFormatPairInterface;
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

    public const REQUEST_KEY_ADDITIONAL_NOTE = 'additionalNote';
    public const REQUEST_KEY_ADDITIONAL_NOTE_VALUES = 'additionalNoteValues';

    public function __construct(
        protected Request $shopRequest,
        protected NutritionFactsFactoryInterface $nutritionFactsFactory,
    ) {
    }

    public function getProductId(): string
    {
        return $this->getStringParameter(self::REQUEST_KEY_PRODUCT_ID);
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

    public function getMeasurement(): ValuesFormatPairInterface
    {
        return new ValuesFormatPair(
            format: $this->getStringParameter(self::REQUEST_KEY_MEASUREMENT),
            values: $this->getStringParameter(self::REQUEST_KEY_MEASUREMENT_VALUES),
        );
    }

    private function getStringParameter(string $key): string
    {
        /** @var null|array<string,string>|string $value */
        $value = $this->shopRequest->getRequestParameter($key);

        if (!is_string($value)) {
            throw new InvalidRequestParameterException($key);
        }

        return $value;
    }

    public function getAdditionalNote(): ValuesFormatPairInterface
    {
        return new ValuesFormatPair(
            format: $this->getStringParameter(self::REQUEST_KEY_ADDITIONAL_NOTE),
            values: $this->getStringParameter(self::REQUEST_KEY_ADDITIONAL_NOTE_VALUES),
        );
    }
}
