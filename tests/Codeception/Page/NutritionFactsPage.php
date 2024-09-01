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
    public $nutritionFactsField = "//textarea[@name='facts']";

    public $nutritionFactsSaveButton = "//input[@name='saveData']";
}
