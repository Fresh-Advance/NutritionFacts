<?php

declare(strict_types=1);

namespace FreshAdvance\NutritionFacts\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004194951 extends AbstractMigration
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
                measurement_format VARCHAR(255),
                measurement_values VARCHAR(255), 
                nutrition_facts TEXT,
                PRIMARY KEY (product_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );

        $this->addSql(
            "CREATE TABLE fa_nutrition_facts_relations (
                product_id VARCHAR(32),
                related_product_id VARCHAR(32),
                INDEX (product_id) 
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8"
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
