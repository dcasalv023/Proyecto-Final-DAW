<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120105700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrito_producto DROP FOREIGN KEY FK_62C02DC27645698E');
        $this->addSql('ALTER TABLE carrito_producto DROP FOREIGN KEY FK_62C02DC2DE2CF6E7');
        $this->addSql('DROP TABLE carrito_producto');
        $this->addSql('ALTER TABLE carrito ADD producto_id INT NOT NULL');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT FK_77E6BED57645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('CREATE INDEX IDX_77E6BED57645698E ON carrito (producto_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrito_producto (carrito_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_62C02DC2DE2CF6E7 (carrito_id), INDEX IDX_62C02DC27645698E (producto_id), PRIMARY KEY(carrito_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE carrito_producto ADD CONSTRAINT FK_62C02DC27645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carrito_producto ADD CONSTRAINT FK_62C02DC2DE2CF6E7 FOREIGN KEY (carrito_id) REFERENCES carrito (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carrito DROP FOREIGN KEY FK_77E6BED57645698E');
        $this->addSql('DROP INDEX IDX_77E6BED57645698E ON carrito');
        $this->addSql('ALTER TABLE carrito DROP producto_id');
    }
}
