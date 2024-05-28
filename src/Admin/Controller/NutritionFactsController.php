<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Admin\Controller;

use OxidEsales\Eshop\Application\Controller\Admin\AdminController;

class NutritionFactsController extends AdminController
{
    protected $_sThisTemplate = '@fa_nutrition_facts/admin/nutrition_facts';

    public function render()
    {
        return parent::render();
    }

    public function saveData(): void
    {
    }
}
