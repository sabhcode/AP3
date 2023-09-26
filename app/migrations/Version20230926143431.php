<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926143431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_rank (orderstate_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', order_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', datetime DATETIME NOT NULL, INDEX IDX_C588D2F2B4870385 (orderstate_uuid), INDEX IDX_C588D2F29C8E6AB1 (order_uuid), PRIMARY KEY(orderstate_uuid, order_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_rank ADD CONSTRAINT FK_C588D2F2B4870385 FOREIGN KEY (orderstate_uuid) REFERENCES order_state (uuid)');
        $this->addSql('ALTER TABLE order_rank ADD CONSTRAINT FK_C588D2F29C8E6AB1 FOREIGN KEY (order_uuid) REFERENCES `order` (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_rank DROP FOREIGN KEY FK_C588D2F2B4870385');
        $this->addSql('ALTER TABLE order_rank DROP FOREIGN KEY FK_C588D2F29C8E6AB1');
        $this->addSql('DROP TABLE order_rank');
    }
}
