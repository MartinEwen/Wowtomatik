<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102103119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters ADD guilds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410ED79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id)');
        $this->addSql('CREATE INDEX IDX_3A29410ED79B63FD ON characters (guilds_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410ED79B63FD');
        $this->addSql('DROP INDEX IDX_3A29410ED79B63FD ON characters');
        $this->addSql('ALTER TABLE characters DROP guilds_id');
    }
}
