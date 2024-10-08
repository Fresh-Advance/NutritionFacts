<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Acceptance;

use Codeception\Attribute\Group;
use DateTime;
use FreshAdvance\NutritionFacts\Tests\Codeception\Page\NutritionFactsPage;
use FreshAdvance\NutritionFacts\Tests\Codeception\Support\AcceptanceTester;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Details\ProductDetails;

#[Group("fa_nutrition_facts")]
final class ProductNutritionFactsTabCest
{
    private $articleId = 'justSomeOxArticleID';
    private $articleArtNum = 'test_product_1';

    public function _before(AcceptanceTester $I)
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

    public function _after(AcceptanceTester $I)
    {
        $I->deleteFromDatabase('oxarticles', ['OXID' => $this->articleId]);
        $I->deleteFromDatabase('oxartextends', ['OXID' => $this->articleId]);
        $I->deleteFromDatabase('fa_nutrition_facts', ['product_id' => $this->articleId]);
    }

    public function testNutritionFactsTabIsNotAvailableForProduct(AcceptanceTester $I): void
    {
        $productDetailsPage = new ProductDetails($I);
        $detailsPageUrl = $productDetailsPage->route($this->articleId);
        $I->amOnPage($detailsPageUrl);

        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TAB'));
    }

    public function testNutritionFactsTabIsAvailableForProduct(AcceptanceTester $I): void
    {
        $I->haveInDatabase(
            'fa_nutrition_facts',
            [
                'product_id' => $this->articleId,
                'nutrition_facts' => json_encode([
                    'calories' => '123',
                ]),
            ]
        );

        $productDetailsPage = new ProductDetails($I);
        $detailsPageUrl = $productDetailsPage->route($this->articleId);
        $I->amOnPage($detailsPageUrl);

        $I->click(Translator::translate('FA_NUTRITION_FACTS_TAB'));

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_ENERGY'));
        $I->see('123 kCal');

        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_FAT_TOTAL'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_FAT_SATURATED'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_FAT_TRANS'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_CHOLESTEROL'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_SODIUM'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_CARBOHYDRATE_TOTAL'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_CARBOHYDRATE_FIBER'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_CARBOHYDRATE_SUGARS'));
        $I->dontSee(Translator::translate('FA_NUTRITION_FACTS_TABLE_PROTEIN'));
    }

    public function testAllNutritionFactsFieldsAreShown(AcceptanceTester $I): void
    {
        $I->haveInDatabase(
            'fa_nutrition_facts',
            [
                'product_id' => $this->articleId,
                'nutrition_facts' => json_encode([
                    'calories' => '321',
                    'totalFat' => $totalFat = uniqid(),
                    'saturatedFat' => $fatsSaturated = uniqid(),
                    'transFat' => $fatsTrans = uniqid(),
                    'carbohydrates' => $carbohydrateTotal = uniqid(),
                    'fibre' => $carbohydrateFiber = uniqid(),
                    'sugars' => $carbohydrateSugars = uniqid(),
                    'protein' => $protein = uniqid(),
                    'cholesterol' => $cholesterol = uniqid(),
                    'sodium' => $sodium = uniqid(),
                ]),
            ]
        );

        $productDetailsPage = new ProductDetails($I);
        $detailsPageUrl = $productDetailsPage->route($this->articleId);
        $I->amOnPage($detailsPageUrl);

        $I->click(Translator::translate('FA_NUTRITION_FACTS_TAB'));

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_ENERGY'));
        $I->see('321 kCal');

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_FAT_TOTAL'));
        $I->see($totalFat);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_FAT_SATURATED'));
        $I->see($fatsSaturated);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_FAT_TRANS'));
        $I->see($fatsTrans);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_CHOLESTEROL'));
        $I->see($cholesterol);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_SODIUM'));
        $I->see($sodium);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_CARBOHYDRATE_TOTAL'));
        $I->see($carbohydrateTotal);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_CARBOHYDRATE_FIBER'));
        $I->see($carbohydrateFiber);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_CARBOHYDRATE_SUGARS'));
        $I->see($carbohydrateSugars);

        $I->see(Translator::translate('FA_NUTRITION_FACTS_TABLE_PROTEIN'));
        $I->see($protein);
    }
}
