<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231009100324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_variation (id INT AUTO_INCREMENT NOT NULL, parfum VARCHAR(255) NOT NULL, grammage INT NOT NULL, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FDF6E65AD');
        $this->addSql('DROP INDEX IDX_B6BD307FDF6E65AD ON message');
        $this->addSql('ALTER TABLE message CHANGE admin_id_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F642B8210 ON message (admin_id)');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5ADF6E65AD');
        $this->addSql('DROP INDEX IDX_B3BA5A5ADF6E65AD ON products');
        $this->addSql('ALTER TABLE products CHANGE admin_id_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A642B8210 ON products (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product_variation');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F642B8210');
        $this->addSql('DROP INDEX IDX_B6BD307F642B8210 ON message');
        $this->addSql('ALTER TABLE message CHANGE admin_id admin_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FDF6E65AD FOREIGN KEY (admin_id_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FDF6E65AD ON message (admin_id_id)');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A642B8210');
        $this->addSql('DROP INDEX IDX_B3BA5A5A642B8210 ON products');
        $this->addSql('ALTER TABLE products CHANGE admin_id admin_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5ADF6E65AD FOREIGN KEY (admin_id_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5ADF6E65AD ON products (admin_id_id)');
    }
}
