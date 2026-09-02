<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260902150515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rule ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rule ADD CONSTRAINT FK_46D8ACCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_46D8ACCCA76ED395 ON rule (user_id)');
        $this->addSql('ALTER TABLE scenario ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scenario ADD CONSTRAINT FK_3E45C8D8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3E45C8D8A76ED395 ON scenario (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rule DROP FOREIGN KEY FK_46D8ACCCA76ED395');
        $this->addSql('DROP INDEX IDX_46D8ACCCA76ED395 ON rule');
        $this->addSql('ALTER TABLE rule DROP user_id');
        $this->addSql('ALTER TABLE scenario DROP FOREIGN KEY FK_3E45C8D8A76ED395');
        $this->addSql('DROP INDEX IDX_3E45C8D8A76ED395 ON scenario');
        $this->addSql('ALTER TABLE scenario DROP user_id');
    }
}
