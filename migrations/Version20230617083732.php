<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617083732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_detail_product (cart_detail_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_1EBBD07122E2424 (cart_detail_id), INDEX IDX_1EBBD0714584665A (product_id), PRIMARY KEY(cart_detail_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_detail_product ADD CONSTRAINT FK_1EBBD07122E2424 FOREIGN KEY (cart_detail_id) REFERENCES cart_detail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_detail_product ADD CONSTRAINT FK_1EBBD0714584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_detail_product DROP FOREIGN KEY FK_1EBBD07122E2424');
        $this->addSql('ALTER TABLE cart_detail_product DROP FOREIGN KEY FK_1EBBD0714584665A');
        $this->addSql('DROP TABLE cart_detail_product');
    }
}
