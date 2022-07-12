<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607115603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projets_collaborateurs (projets_id INT NOT NULL, collaborateurs_id INT NOT NULL, INDEX IDX_272E6938597A6CB7 (projets_id), INDEX IDX_272E69385BBF76DC (collaborateurs_id), PRIMARY KEY(projets_id, collaborateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projets_collaborateurs ADD CONSTRAINT FK_272E6938597A6CB7 FOREIGN KEY (projets_id) REFERENCES projets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projets_collaborateurs ADD CONSTRAINT FK_272E69385BBF76DC FOREIGN KEY (collaborateurs_id) REFERENCES collaborateurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE projets_collaborateurs');
    }
}
