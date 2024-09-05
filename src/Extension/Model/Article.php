<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Extension\Model;

use OxidEsales\Eshop\Application\Model\Article as ArticleModel;

/**
 * @eshopExtension
 *
 * @mixin ArticleModel
 */
class Article extends Article_parent
{
    public function getNutritionFacts(): array
    {
        return ['example'];
    }
}
