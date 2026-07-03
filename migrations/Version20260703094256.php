<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260703094256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE scenario_user (scenario_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_ED5E0075E04E49DF (scenario_id), INDEX IDX_ED5E0075A76ED395 (user_id), PRIMARY KEY (scenario_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE scenario_user ADD CONSTRAINT FK_ED5E0075E04E49DF FOREIGN KEY (scenario_id) REFERENCES scenario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scenario_user ADD CONSTRAINT FK_ED5E0075A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scenario_user DROP FOREIGN KEY FK_ED5E0075E04E49DF');
        $this->addSql('ALTER TABLE scenario_user DROP FOREIGN KEY FK_ED5E0075A76ED395');
        $this->addSql('DROP TABLE scenario_user');
    }
}
