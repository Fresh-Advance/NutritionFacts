<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Codeception\Acceptance;

use Codeception\Attribute\Group;
use DateTime;
use FreshAdvance\NutritionFacts\Tests\Codeception\Page\NutritionFactsPage;
use FreshAdvance\NutritionFacts\Tests\Codeception\Support\AcceptanceTester;
use OxidEsales\Codeception\Module\Translation\Translator;

#[Group("fa_nutrition_facts")]
final class ProductNutritionFactsEditCest
{
    private $articleId = 'justSomeOxArticleID';
    private $articleArtNum = 'test_product_1';

    /** @param AcceptanceTester $I */
    public function _before(AcceptanceTester $I)
    {
        $this->insertProductInDatabase($I);
    }

    public function testNutritionFactsTabAvailable(AcceptanceTester $I): void
    {
        $I->wantToTest('Product nutrition facts tab is available');

        $adminPanel = $I->loginAdmin();

        $products = $adminPanel->openProducts();
        $products->find($products->searchNumberInput, $this->articleArtNum);

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_fa_nutrition_facts'));
        $I->selectEditFrame();

        $I->seeElement("form");
    }

    public function testNutritionFactsCanBeSavedForProduct(AcceptanceTester $I): void
    {
        $I->wantToTest('Product nutrition data can be saved');

        $adminPanel = $I->loginAdmin();

        $products = $adminPanel->openProducts();
        $products->find($products->searchNumberInput, $this->articleArtNum);

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_fa_nutrition_facts'));
        $I->selectEditFrame();

        $nutritionsPage = new NutritionFactsPage($I);

        $fields = [
            'totalFat',
            'saturatedFat',
            'transFat',
            'carbohydrates',
            'fibre',
            'sugars',
            'protein',
            'cholesterol',
            'sodium',
        ];

        $calories = (string)rand(1, 1000);
        $I->fillField(sprintf($nutritionsPage->nutritionFactsField, 'calories'), $calories);
        foreach ($fields as $key => $oneField) {
            $I->fillField(sprintf($nutritionsPage->nutritionFactsField, $oneField), md5($key . $oneField));
        }

        $I->click($nutritionsPage->nutritionFactsSaveButton);
        $I->waitForPageLoad();

        $I->seeInField(sprintf($nutritionsPage->nutritionFactsField, 'calories'), $calories);
        foreach ($fields as $key => $oneField) {
            $I->seeInField(sprintf($nutritionsPage->nutritionFactsField, $oneField), md5($key . $oneField));
        }
    }

    /** @param AcceptanceTester $I */
    private function insertProductInDatabase(AcceptanceTester $I): void
    {
        $I->haveInDatabase(
            'oxarticles',
            [
                'OXID' => $this->articleId,
                'oxartnum' => $this->articleArtNum,
                'OXTITLE' => 'Test product 2 [EN] šÄßüл',
                'OXSHORTDESC' => 'Test product 2 short desc [EN] šÄßüл',
                'OXACTIVEFROM' => (new DateTime())->format('Y-m-d 00:00:00'),
                'OXACTIVETO' => (new DateTime())->modify('+1 week')->format('Y-m-d 00:00:00'),
                'OXDELIVERY' => (new DateTime())->format('Y-m-d 00:00:00'),
                'OXINSERT' => (new DateTime())->format('Y-m-d 00:00:00'),
                'OXUPDATEPRICETIME' => (new DateTime())->format('Y-m-d 00:00:00'),
            ]
        );

        $I->haveInDatabase(
            'oxartextends',
            [
                'OXID' => $this->articleId,
                'OXLONGDESC' => uniqid(),
                'OXLONGDESC_1' => uniqid(),
                'OXLONGDESC_2' => uniqid(),
                'OXLONGDESC_3' => uniqid(),
            ]
        );
    }
}
