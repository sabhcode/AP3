<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006081816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
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
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_1CF73D315AE42AE1');
        $this->addSql('ALTER TABLE product ADD nb_ventes INT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_1cf73d315ae42ae1 ON product');
        $this->addSql('CREATE INDEX IDX_D34A04AD5AE42AE1 ON product (category_uuid)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_1CF73D315AE42AE1 FOREIGN KEY (category_uuid) REFERENCES category (uuid)');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_8AF7796433C6FE68');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_8AF779645C977207');
        $this->addSql('DROP INDEX idx_8af7796433c6fe68 ON stock');
        $this->addSql('CREATE INDEX IDX_4B36566033C6FE68 ON stock (store_uuid)');
        $this->addSql('DROP INDEX idx_8af779645c977207 ON stock');
        $this->addSql('CREATE INDEX IDX_4B3656605C977207 ON stock (product_uuid)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_8AF7796433C6FE68 FOREIGN KEY (store_uuid) REFERENCES store (uuid)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_8AF779645C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('ALTER TABLE store ADD name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_2DA17977A5D24B55');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('DROP INDEX uniq_2da17977a5d24b55 ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A5D24B55 ON user (credential_email)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_2DA17977A5D24B55 FOREIGN KEY (credential_email) REFERENCES credential (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B4870385');
        $this->addSql('DROP INDEX IDX_F5299398B4870385 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP orderstate_uuid');
        $this->addSql('ALTER TABLE order_rank DROP FOREIGN KEY FK_C588D2F2F6462435');
        $this->addSql('DROP INDEX IDX_C588D2F2F6462435 ON order_rank');
        $this->addSql('DROP INDEX `PRIMARY` ON order_rank');
        $this->addSql('ALTER TABLE order_rank CHANGE order_state_uuid orderstate_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', CHANGE datetime date_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE order_rank ADD CONSTRAINT FK_C588D2F2B4870385 FOREIGN KEY (orderstate_uuid) REFERENCES order_state (uuid)');
        $this->addSql('CREATE INDEX IDX_C588D2F2B4870385 ON order_rank (orderstate_uuid)');
        $this->addSql('ALTER TABLE order_rank ADD PRIMARY KEY (order_uuid, orderstate_uuid)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5AE42AE1');
        $this->addSql('ALTER TABLE product DROP nb_ventes, CHANGE image image VARCHAR(100) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1CF73D315E237E06 ON product (name)');
        $this->addSql('DROP INDEX idx_d34a04ad5ae42ae1 ON product');
        $this->addSql('CREATE INDEX IDX_1CF73D315AE42AE1 ON product (category_uuid)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5AE42AE1 FOREIGN KEY (category_uuid) REFERENCES category (uuid)');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566033C6FE68');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656605C977207');
        $this->addSql('DROP INDEX idx_4b36566033c6fe68 ON stock');
        $this->addSql('CREATE INDEX IDX_8AF7796433C6FE68 ON stock (store_uuid)');
        $this->addSql('DROP INDEX idx_4b3656605c977207 ON stock');
        $this->addSql('CREATE INDEX IDX_8AF779645C977207 ON stock (product_uuid)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566033C6FE68 FOREIGN KEY (store_uuid) REFERENCES store (uuid)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656605C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('ALTER TABLE store DROP name');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A5D24B55');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('DROP INDEX uniq_8d93d649a5d24b55 ON user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2DA17977A5D24B55 ON user (credential_email)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A5D24B55 FOREIGN KEY (credential_email) REFERENCES credential (email)');
    }
}
