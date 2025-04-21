# Nutrition facts module for OXID eShop

[![Development](https://github.com/Fresh-Advance/NutritionFacts/actions/workflows/trigger.yaml/badge.svg?branch=b-7.1.x)](https://github.com/Fresh-Advance/NutritionFacts/actions/workflows/trigger.yaml)
[![Latest Version](https://img.shields.io/packagist/v/Fresh-Advance/NutritionFacts?logo=composer&label=latest&include_prereleases&color=orange)](https://packagist.org/packages/Fresh-Advance/NutritionFacts)
[![PHP Version](https://img.shields.io/packagist/php-v/Fresh-Advance/NutritionFacts)](https://github.com/Fresh-Advance/NutritionFacts)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Fresh-Advance_NutritionFacts&metric=alert_status)](https://sonarcloud.io/dashboard?id=Fresh-Advance_NutritionFacts)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=Fresh-Advance_NutritionFacts&metric=coverage)](https://sonarcloud.io/dashboard?id=Fresh-Advance_NutritionFacts)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=Fresh-Advance_NutritionFacts&metric=sqale_index)](https://sonarcloud.io/dashboard?id=Fresh-Advance_NutritionFacts)

OXID eShop 7 Product nutrition facts module gives you a possibility to add a nutrition facts table to the product detail page.

## Features

* Add nutrition facts to the product detail page separate tab - Nutrition tabs
  * Basic values are currently editable:
    * Calories
    * Total Fat
      * Saturated Fat
      * Trans Fat
    * Carbohydrates
    * Fibre
    * Sugars
    * Protein
    * Cholesterol
    * Sodium
* Possibility to describe the measurement unit for each product
* Possibility to add additional information to the nutrition facts table

## Interface

![image](https://github.com/user-attachments/assets/8f2efdeb-7db9-4c52-a251-4ae3cfcf20f9)
![image](https://github.com/user-attachments/assets/4f4c1074-d003-41eb-a3c8-1efe66d69a42)

## Compatibility

* Branch b-7.1.x is compatible with OXID Shop compilation 7.1.x and up
* Branch b-7.0.x is compatible with OXID Shop compilation 7.0.0-rc.2 and up

## Installation

Module is available on packagist. Install it via composer and activate the module

```
composer require fresh-advance/nutrition-facts
vendor/bin/oe-console oe:module:activate fa_nutrition_facts
```
