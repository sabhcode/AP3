<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231015100529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BABFE1C6F FOREIGN KEY (user_uuid) REFERENCES user (uuid)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B5C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('ALTER TABLE user ADD address VARCHAR(255) NOT NULL, ADD postcode VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BABFE1C6F');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B5C977207');
        $this->addSql('ALTER TABLE user DROP address, DROP postcode, DROP city, DROP phone');
    }
}
