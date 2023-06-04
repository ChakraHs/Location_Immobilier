<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230603160000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE aproprietaire ADD puser_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE aproprietaire ADD CONSTRAINT FK_CE271AE0F3704212 FOREIGN KEY (puser_id) REFERENCES user (id)');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_CE271AE0F3704212 ON aproprietaire (puser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE aproprietaire DROP FOREIGN KEY FK_CE271AE0F3704212');
        // $this->addSql('DROP INDEX UNIQ_CE271AE0F3704212 ON aproprietaire');
        // $this->addSql('ALTER TABLE aproprietaire DROP puser_id');
    }
}
