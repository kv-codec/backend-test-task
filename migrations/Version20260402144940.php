<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260402144940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            CREATE TABLE coupon (
                id BIGSERIAL PRIMARY KEY,
                code VARCHAR(255) NOT NULL,
                type VARCHAR(255) NOT NULL,
                discount_size INT NOT NULL CHECK (
                    CASE
                        WHEN "type" = 'percent' THEN discount_size BETWEEN 0 AND 100
                        ELSE discount_size >= 0
                    END
                )
            )
            SQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coupon');
    }
}
