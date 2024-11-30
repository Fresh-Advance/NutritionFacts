<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Codeception\Page;

use OxidEsales\Codeception\Admin\Product\ProductList;
use OxidEsales\Codeception\Page\Page;

class NutritionFactsPage extends Page
{
    use ProductList;

    // Reference Intake
    public $nutritionFactsField = "//input[@name='nutritionFacts[%s]']";

    public $measurementFormatField = "//select[@name='measurement']";
    public $measurementFormatValuesField = "//input[@name='measurementValues']";

    public $additionalNoteFormatField = "//select[@name='additionalNote']";
    public $additionalNoteFormatValuesField = "//input[@name='additionalNoteValues']";

    public $nutritionFactsSaveButton = "//input[@name='saveData']";
}
