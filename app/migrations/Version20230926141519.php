<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926141519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (user_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', product_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_2246507BABFE1C6F (user_uuid), INDEX IDX_2246507B5C977207 (product_uuid), PRIMARY KEY(user_uuid, product_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credentials (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, lastconnection DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', orderstate_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date_time DATETIME NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_F5299398B4870385 (orderstate_uuid), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (order_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', product_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_ED896F469C8E6AB1 (order_uuid), INDEX IDX_ED896F465C977207 (product_uuid), PRIMARY KEY(order_uuid, product_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_state (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', category_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, image LONGBLOB NOT NULL, INDEX IDX_D34A04AD5AE42AE1 (category_uuid), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (store_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', product_uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_4B36566033C6FE68 (store_uuid), INDEX IDX_4B3656605C977207 (product_uuid), PRIMARY KEY(store_uuid, product_uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', credential_email_id INT NOT NULL, roles JSON NOT NULL, name VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, adress LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_8D93D64977660CF8 (credential_email_id), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BABFE1C6F FOREIGN KEY (user_uuid) REFERENCES user (uuid)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B5C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398B4870385 FOREIGN KEY (orderstate_uuid) REFERENCES order_state (uuid)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F469C8E6AB1 FOREIGN KEY (order_uuid) REFERENCES `order` (uuid)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F465C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5AE42AE1 FOREIGN KEY (category_uuid) REFERENCES category (uuid)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566033C6FE68 FOREIGN KEY (store_uuid) REFERENCES store (uuid)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656605C977207 FOREIGN KEY (product_uuid) REFERENCES product (uuid)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64977660CF8 FOREIGN KEY (credential_email_id) REFERENCES credentials (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BABFE1C6F');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B5C977207');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398B4870385');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F469C8E6AB1');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F465C977207');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5AE42AE1');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566033C6FE68');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656605C977207');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64977660CF8');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE credentials');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE order_state');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
