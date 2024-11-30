<?php

declare(strict_types=1);

$aLang = [];

require __DIR__ . "/../../../translations/en/module_en_lang.php";

$aLang = array_merge($aLang, [
    'charset' => 'UTF-8',
    'tbclarticle_fa_nutrition_facts' => 'Nutrition facts',

    'SHOP_MODULE_GROUP_fa_nutrition_facts_settings_edit' => 'Nutrition Facts Settings',
    'SHOP_MODULE_fa_nutrition_facts_MeasurementOptions' => 'Measurement options',
    'HELP_SHOP_MODULE_fa_nutrition_facts_MeasurementOptions' => 'Array of options for measurment. Key is the measurement translation key, value is the default parameters for the translation, separated by ; if there are multiple. Example: FA_NUTRITION_FACTS_MEASUREMENT => 100g;another',

    'FA_NUTRITION_FACTS_FORM_SAVE' => 'Save',
]);
