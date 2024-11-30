<?php

declare(strict_types=1);

$aLang = [];

require __DIR__ . "/../../../translations/de/module_de_lang.php";

//deutsch translation
$aLang = array_merge($aLang, [
    'charset' => 'UTF-8',
    'tbclarticle_fa_nutrition_facts' => 'Nährwertangaben',

    'SHOP_MODULE_GROUP_fa_nutrition_facts_settings_edit' => 'Nährwertangaben Einstellungen',
    'SHOP_MODULE_fa_nutrition_facts_MeasurementOptions' => 'Messungsoptionen',
    'HELP_SHOP_MODULE_fa_nutrition_facts_MeasurementOptions' => 'Array von Optionen für die Messung. Der Schlüssel ist der Messungsschlüssel, der Wert sind die Standardparameter für die Übersetzung, getrennt durch ; wenn es mehrere gibt. Beispiel: FA_NUTRITION_FACTS_MEASUREMENT => 100g;another',

    'FA_NUTRITION_FACTS_FORM_SAVE' => 'Speichern',
]);
