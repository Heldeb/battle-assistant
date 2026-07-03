<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703155339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE battlefield_component (battlefield_id INT NOT NULL, component_id INT NOT NULL, INDEX IDX_127C3EAFAE052AE (battlefield_id), INDEX IDX_127C3EAE2ABAFFF (component_id), PRIMARY KEY (battlefield_id, component_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE battlefield_component ADD CONSTRAINT FK_127C3EAFAE052AE FOREIGN KEY (battlefield_id) REFERENCES battlefield (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE battlefield_component ADD CONSTRAINT FK_127C3EAE2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE battlefield_component DROP FOREIGN KEY FK_127C3EAFAE052AE');
        $this->addSql('ALTER TABLE battlefield_component DROP FOREIGN KEY FK_127C3EAE2ABAFFF');
        $this->addSql('DROP TABLE battlefield_component');
    }
}
