<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id' => 'fa_nutrition_facts',
    'title' => 'Nutrition Facts',
    'description' => [
        'en' => 'Nutrition Facts module for OXID eShop.',
    ],
    'thumbnail' => 'logo.png',
    'version' => '0.1.0',
    'author' => 'Anton Fedurtsya',
    'email' => 'anton@fedurtsya.com',
    'url' => 'https://github.com/Fresh-Advance',
    'controllers' => [
        'fa_nutrition_facts_admin' => \FreshAdvance\NutritionFacts\Admin\Controller\NutritionFactsController::class,
    ],
    'extend' => [
    ],
    'settings' => [
    ],
    'events' => [
    ],
    'templates' => [
    ]
];
