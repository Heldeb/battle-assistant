<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703114548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE played_games ADD CONSTRAINT FK_445FF983A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE played_games ADD CONSTRAINT FK_445FF983E04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE played_games DROP FOREIGN KEY FK_445FF983A76ED395');
        $this->addSql('ALTER TABLE played_games DROP FOREIGN KEY FK_445FF983E04E49DF');
    }
}
