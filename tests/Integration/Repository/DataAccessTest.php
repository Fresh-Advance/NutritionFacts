<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Tests\Integration\Repository;

use FreshAdvance\NutritionFacts\Repository\FactsDataAccessInterface;
use OxidEsales\EshopCommunity\Tests\Integration\IntegrationTestCase;

class DataAccessTest extends IntegrationTestCase
{
    public function testDataFlow(): void
    {
        $sut = $this->getSut();

        $exampleId = uniqid();
        $data = '{"key1": "value1", "key2": "value2"}';

        $this->assertTrue($sut->saveFactsData($exampleId, $data));
        $this->assertEquals($data, $sut->getFactsData($exampleId));
    }

    public function getSut(): FactsDataAccessInterface
    {
        return $this->get(FactsDataAccessInterface::class);
    }
}
