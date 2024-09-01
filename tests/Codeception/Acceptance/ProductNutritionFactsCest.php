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
final class ProductNutritionFactsCest
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

        $nutritionsPage = new NutritionFactsPage($I);

        $value = <<<BLOCK
        example:
          product: productIdExample
          facts:
            fact1: value1
            fact2: value2
        
        BLOCK;

        $I->fillField($nutritionsPage->nutritionFactsField, $value);

        $I->click($nutritionsPage->nutritionFactsSaveButton);
        $I->waitForPageLoad();

        $I->assertSame($value, $I->grabValueFrom($nutritionsPage->nutritionFactsField));
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
    }
}
