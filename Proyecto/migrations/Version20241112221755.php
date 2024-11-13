<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112221755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrito (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_77E6BED5DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrito_producto (carrito_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_62C02DC2DE2CF6E7 (carrito_id), INDEX IDX_62C02DC27645698E (producto_id), PRIMARY KEY(carrito_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_orden (id INT AUTO_INCREMENT NOT NULL, orden_id INT NOT NULL, cantidad INT NOT NULL, precio_unitario DOUBLE PRECISION NOT NULL, INDEX IDX_3F5E85839750851F (orden_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detalle_orden_producto (detalle_orden_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_4BBED3D34F15702B (detalle_orden_id), INDEX IDX_4BBED3D37645698E (producto_id), PRIMARY KEY(detalle_orden_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lista_deseos (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_DAB13E44DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lista_deseos_producto (lista_deseos_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_AFE52B6CEC717891 (lista_deseos_id), INDEX IDX_AFE52B6C7645698E (producto_id), PRIMARY KEY(lista_deseos_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orden (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, date DATETIME NOT NULL, estado VARCHAR(255) NOT NULL, INDEX IDX_E128CFD7DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, imagen_url VARCHAR(255) NOT NULL, INDEX IDX_A7BB06153397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, registratio_date DATETIME NOT NULL, rol VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT FK_77E6BED5DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE carrito_producto ADD CONSTRAINT FK_62C02DC2DE2CF6E7 FOREIGN KEY (carrito_id) REFERENCES carrito (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carrito_producto ADD CONSTRAINT FK_62C02DC27645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_orden ADD CONSTRAINT FK_3F5E85839750851F FOREIGN KEY (orden_id) REFERENCES orden (id)');
        $this->addSql('ALTER TABLE detalle_orden_producto ADD CONSTRAINT FK_4BBED3D34F15702B FOREIGN KEY (detalle_orden_id) REFERENCES detalle_orden (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_orden_producto ADD CONSTRAINT FK_4BBED3D37645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lista_deseos ADD CONSTRAINT FK_DAB13E44DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE lista_deseos_producto ADD CONSTRAINT FK_AFE52B6CEC717891 FOREIGN KEY (lista_deseos_id) REFERENCES lista_deseos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lista_deseos_producto ADD CONSTRAINT FK_AFE52B6C7645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orden ADD CONSTRAINT FK_E128CFD7DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06153397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrito DROP FOREIGN KEY FK_77E6BED5DB38439E');
        $this->addSql('ALTER TABLE carrito_producto DROP FOREIGN KEY FK_62C02DC2DE2CF6E7');
        $this->addSql('ALTER TABLE carrito_producto DROP FOREIGN KEY FK_62C02DC27645698E');
        $this->addSql('ALTER TABLE detalle_orden DROP FOREIGN KEY FK_3F5E85839750851F');
        $this->addSql('ALTER TABLE detalle_orden_producto DROP FOREIGN KEY FK_4BBED3D34F15702B');
        $this->addSql('ALTER TABLE detalle_orden_producto DROP FOREIGN KEY FK_4BBED3D37645698E');
        $this->addSql('ALTER TABLE lista_deseos DROP FOREIGN KEY FK_DAB13E44DB38439E');
        $this->addSql('ALTER TABLE lista_deseos_producto DROP FOREIGN KEY FK_AFE52B6CEC717891');
        $this->addSql('ALTER TABLE lista_deseos_producto DROP FOREIGN KEY FK_AFE52B6C7645698E');
        $this->addSql('ALTER TABLE orden DROP FOREIGN KEY FK_E128CFD7DB38439E');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06153397707A');
        $this->addSql('DROP TABLE carrito');
        $this->addSql('DROP TABLE carrito_producto');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE detalle_orden');
        $this->addSql('DROP TABLE detalle_orden_producto');
        $this->addSql('DROP TABLE lista_deseos');
        $this->addSql('DROP TABLE lista_deseos_producto');
        $this->addSql('DROP TABLE orden');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
