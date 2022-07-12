<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705082523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projets ADD competences_id INT DEFAULT NULL, CHANGE type_technologie type_technologie VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE projets ADD CONSTRAINT FK_B454C1DBA660B158 FOREIGN KEY (competences_id) REFERENCES competences (id)');
        $this->addSql('CREATE INDEX IDX_B454C1DBA660B158 ON projets (competences_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projets DROP FOREIGN KEY FK_B454C1DBA660B158');
        $this->addSql('DROP INDEX IDX_B454C1DBA660B158 ON projets');
        $this->addSql('ALTER TABLE projets DROP competences_id, CHANGE type_technologie type_technologie VARCHAR(255) DEFAULT NULL');
    }
}
