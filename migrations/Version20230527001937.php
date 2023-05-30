<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230527001937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aclient ADD cuser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aclient ADD CONSTRAINT FK_C62B3DD914474DA FOREIGN KEY (cuser_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C62B3DD914474DA ON aclient (cuser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aclient DROP FOREIGN KEY FK_C62B3DD914474DA');
        $this->addSql('DROP INDEX UNIQ_C62B3DD914474DA ON aclient');
        $this->addSql('ALTER TABLE aclient DROP cuser_id');
    }
}
