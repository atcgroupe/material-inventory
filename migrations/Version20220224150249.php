<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224150249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE format_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE material_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE piece_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_piece_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE format (id INT NOT NULL, width INT NOT NULL, height INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE material (id INT NOT NULL, name VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE piece (id INT NOT NULL, material_id INT NOT NULL, width INT NOT NULL, height INT NOT NULL, printable_faces SMALLINT NOT NULL, quantity SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_44CA0B23E308AC6F ON piece (material_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, creation_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivery_date DATE NOT NULL, job_id VARCHAR(20) NOT NULL, job_customer VARCHAR(100) NOT NULL, user_identifier VARCHAR(50) NOT NULL, status SMALLINT NOT NULL, status_comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation_piece (id INT NOT NULL, piece_id INT NOT NULL, reservation_id INT NOT NULL, quantity SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7B5DB84C40FCFA8 ON reservation_piece (piece_id)');
        $this->addSql('CREATE INDEX IDX_7B5DB84B83297E7 ON reservation_piece (reservation_id)');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_material (tag_id INT NOT NULL, material_id INT NOT NULL, PRIMARY KEY(tag_id, material_id))');
        $this->addSql('CREATE INDEX IDX_4A8F0E4EBAD26311 ON tag_material (tag_id)');
        $this->addSql('CREATE INDEX IDX_4A8F0E4EE308AC6F ON tag_material (material_id)');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B23E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_piece ADD CONSTRAINT FK_7B5DB84C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation_piece ADD CONSTRAINT FK_7B5DB84B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_material ADD CONSTRAINT FK_4A8F0E4EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_material ADD CONSTRAINT FK_4A8F0E4EE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE piece DROP CONSTRAINT FK_44CA0B23E308AC6F');
        $this->addSql('ALTER TABLE tag_material DROP CONSTRAINT FK_4A8F0E4EE308AC6F');
        $this->addSql('ALTER TABLE reservation_piece DROP CONSTRAINT FK_7B5DB84C40FCFA8');
        $this->addSql('ALTER TABLE reservation_piece DROP CONSTRAINT FK_7B5DB84B83297E7');
        $this->addSql('ALTER TABLE tag_material DROP CONSTRAINT FK_4A8F0E4EBAD26311');
        $this->addSql('DROP SEQUENCE format_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE material_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE piece_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_piece_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_piece');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_material');
    }
}
