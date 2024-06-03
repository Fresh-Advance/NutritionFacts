<?php

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240530184716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "CREATE TABLE fa_nutrition_facts (
                product_id VARCHAR(32),
                nutrition_facts JSON,
                PRIMARY KEY (product_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );
    }

    public function down(Schema $schema): void
    {
    }
}
