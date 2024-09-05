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
    'id' => \FreshAdvance\NutritionFacts\Service\ModuleSettingsServiceInterface::MODULE_ID,
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
        \OxidEsales\Eshop\Application\Model\Article::class => \FreshAdvance\NutritionFacts\Extension\Model\Article::class
    ],
    'settings' => [
        [
            'group' => 'fa_nutrition_facts_defaults',
            'name'  => \FreshAdvance\NutritionFacts\Service\ModuleSettingsServiceInterface::SETTING_DEFAULT_FACTS,
            'type'  => 'aarr',
            'value' => [
                'fact_energy_value' => '? kJ / ? kcal',
                'fact_fats' => '',
                'fact_fats_saturated' => '',
                'fact_carbohydrates' => '',
                'fact_sugars' => '',
                'fact_proteins' => '',
                'fact_salt' => '',
            ]
        ],
    ],
    'events' => [
    ],
    'templates' => [
    ]
];
