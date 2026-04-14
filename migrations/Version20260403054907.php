<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260403054907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            CREATE TABLE tax (
                id BIGSERIAL PRIMARY KEY,
                rate INT NOT NULL CHECK (rate >= 0),
                geo_code VARCHAR(255) NOT NULL
            )
            SQL;
        $this->addSql(
            $sql,
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = <<<SQL
            DROP TABLE tax
            SQL;
        $this->addSql($sql);
    }
}
