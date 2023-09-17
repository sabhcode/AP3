<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230917110637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail ADD PRIMARY KEY (order_uuid, product_uuid)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F469C8E6AB1 FOREIGN KEY (order_uuid) REFERENCES `order` (uuid)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F465C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('CREATE INDEX IDX_ED896F469C8E6AB1 ON order_detail (order_uuid)');
        $this->addSql('CREATE INDEX IDX_ED896F465C977207 ON order_detail (product_uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F469C8E6AB1');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F465C977207');
        $this->addSql('DROP INDEX IDX_ED896F469C8E6AB1 ON order_detail');
        $this->addSql('DROP INDEX IDX_ED896F465C977207 ON order_detail');
        $this->addSql('DROP INDEX `primary` ON order_detail');
    }
}
