<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607101244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_379A476E7927C74 ON chefs_projets (email)');
        $this->addSql('ALTER TABLE projets ADD chefs_projets_id INT NOT NULL');
        $this->addSql('ALTER TABLE projets ADD CONSTRAINT FK_B454C1DBD58F61A4 FOREIGN KEY (chefs_projets_id) REFERENCES chefs_projets (id)');
        $this->addSql('CREATE INDEX IDX_B454C1DBD58F61A4 ON projets (chefs_projets_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_379A476E7927C74 ON chefs_projets');
        $this->addSql('ALTER TABLE projets DROP FOREIGN KEY FK_B454C1DBD58F61A4');
        $this->addSql('DROP INDEX IDX_B454C1DBD58F61A4 ON projets');
        $this->addSql('ALTER TABLE projets DROP chefs_projets_id');
    }
}
