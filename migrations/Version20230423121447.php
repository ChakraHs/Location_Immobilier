<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230423121447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5B83297E7');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E539DFD59B');
        $this->addSql('ALTER TABLE category_bien DROP FOREIGN KEY FK_CE76B9C18805AB2F');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455B83297E7');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F76C50E4A');
        $this->addSql('ALTER TABLE proprietaire DROP FOREIGN KEY FK_69E399D68805AB2F');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE category_bien');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_immo');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE reservation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, image_immo_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, a_prix DOUBLE PRECISION NOT NULL, a_ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, a_rue VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, a_num_immo INT NOT NULL, a_etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, a_traite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F65593E539DFD59B (image_immo_id), INDEX IDX_F65593E5B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_bien (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, cat_nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CE76B9C18805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, c_nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, c_prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, c_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, c_mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, c_tele BIGINT NOT NULL, INDEX IDX_C7440455B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT DEFAULT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C53D045F76C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image_immo (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, p_nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, p_prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, p_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, p_mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, p_tele BIGINT NOT NULL, p_cin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, p_cin_image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_69E399D68805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, r_date_entree DATE NOT NULL, r_nombre_mois INT NOT NULL, r_contrat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E539DFD59B FOREIGN KEY (image_immo_id) REFERENCES image_immo (id)');
        $this->addSql('ALTER TABLE category_bien ADD CONSTRAINT FK_CE76B9C18805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE proprietaire ADD CONSTRAINT FK_69E399D68805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }
}
