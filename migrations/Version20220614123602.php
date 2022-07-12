<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614123602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competences_collaborateurs (competences_id INT NOT NULL, collaborateurs_id INT NOT NULL, INDEX IDX_A0274D77A660B158 (competences_id), INDEX IDX_A0274D775BBF76DC (collaborateurs_id), PRIMARY KEY(competences_id, collaborateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competences_collaborateurs ADD CONSTRAINT FK_A0274D77A660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_collaborateurs ADD CONSTRAINT FK_A0274D775BBF76DC FOREIGN KEY (collaborateurs_id) REFERENCES collaborateurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE competences_collaborateurs');
    }
}
