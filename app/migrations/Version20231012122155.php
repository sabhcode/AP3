<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012122155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B5C977207');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BABFE1C6F');
        $this->addSql('DROP TABLE basket');
        $this->addSql('ALTER TABLE `order` ADD orderstate_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B4870385 FOREIGN KEY (orderstate_uuid) REFERENCES order_state (uuid)');
        $this->addSql('CREATE INDEX IDX_F5299398B4870385 ON `order` (orderstate_uuid)');
        $this->addSql('ALTER TABLE order_rank DROP FOREIGN KEY FK_C588D2F2B4870385');
        $this->addSql('DROP INDEX IDX_C588D2F2B4870385 ON order_rank');
        $this->addSql('DROP INDEX `primary` ON order_rank');
        $this->addSql('ALTER TABLE order_rank CHANGE orderstate_uuid order_state_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE date_time datetime DATETIME NOT NULL');
        $this->addSql('ALTER TABLE order_rank ADD CONSTRAINT FK_C588D2F2F6462435 FOREIGN KEY (order_state_uuid) REFERENCES order_state (uuid)');
        $this->addSql('CREATE INDEX IDX_C588D2F2F6462435 ON order_rank (order_state_uuid)');
        $this->addSql('ALTER TABLE order_rank ADD PRIMARY KEY (order_state_uuid, order_uuid)');
        $this->addSql('DROP INDEX UNIQ_1CF73D315E237E06 ON product');
        $this->addSql('ALTER TABLE product DROP nb_sales, CHANGE image image LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_1cf73d315ae42ae1 TO IDX_D34A04AD5AE42AE1');
        $this->addSql('ALTER TABLE stock RENAME INDEX idx_8af7796433c6fe68 TO IDX_4B36566033C6FE68');
        $this->addSql('ALTER TABLE stock RENAME INDEX idx_8af779645c977207 TO IDX_4B3656605C977207');
        $this->addSql('ALTER TABLE store ADD name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE user ADD address VARCHAR(255) NOT NULL, ADD postcode VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_2da17977a5d24b55 TO UNIQ_8D93D649A5D24B55');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (user_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', product_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_2246507BABFE1C6F (user_uuid), INDEX IDX_2246507B5C977207 (product_uuid), PRIMARY KEY(user_uuid, product_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B5C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BABFE1C6F FOREIGN KEY (user_uuid) REFERENCES user (uuid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user DROP address, DROP postcode, DROP city, DROP phone');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649a5d24b55 TO UNIQ_2DA17977A5D24B55');
        $this->addSql('ALTER TABLE product ADD nb_sales INT NOT NULL, CHANGE image image VARCHAR(100) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1CF73D315E237E06 ON product (name)');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04ad5ae42ae1 TO IDX_1CF73D315AE42AE1');
        $this->addSql('ALTER TABLE store DROP name');
        $this->addSql('ALTER TABLE stock RENAME INDEX idx_4b36566033c6fe68 TO IDX_8AF7796433C6FE68');
        $this->addSql('ALTER TABLE stock RENAME INDEX idx_4b3656605c977207 TO IDX_8AF779645C977207');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B4870385');
        $this->addSql('DROP INDEX IDX_F5299398B4870385 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP orderstate_uuid');
        $this->addSql('ALTER TABLE order_rank DROP FOREIGN KEY FK_C588D2F2F6462435');
        $this->addSql('DROP INDEX IDX_C588D2F2F6462435 ON order_rank');
        $this->addSql('DROP INDEX `PRIMARY` ON order_rank');
        $this->addSql('ALTER TABLE order_rank CHANGE order_state_uuid orderstate_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE datetime date_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE order_rank ADD CONSTRAINT FK_C588D2F2B4870385 FOREIGN KEY (orderstate_uuid) REFERENCES order_state (uuid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C588D2F2B4870385 ON order_rank (orderstate_uuid)');
        $this->addSql('ALTER TABLE order_rank ADD PRIMARY KEY (order_uuid, orderstate_uuid)');
    }
}
