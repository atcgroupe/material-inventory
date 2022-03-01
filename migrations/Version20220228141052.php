<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228141052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE format ADD material_id INT NOT NULL');
        $this->addSql('ALTER TABLE format ADD CONSTRAINT FK_DEBA72DFE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DEBA72DFE308AC6F ON format (material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE format DROP CONSTRAINT FK_DEBA72DFE308AC6F');
        $this->addSql('DROP INDEX IDX_DEBA72DFE308AC6F');
        $this->addSql('ALTER TABLE format DROP material_id');
    }
}
