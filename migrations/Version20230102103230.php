<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102103230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events ADD guilds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AD79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id)');
        $this->addSql('CREATE INDEX IDX_5387574AD79B63FD ON events (guilds_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AD79B63FD');
        $this->addSql('DROP INDEX IDX_5387574AD79B63FD ON events');
        $this->addSql('ALTER TABLE events DROP guilds_id');
    }
}
