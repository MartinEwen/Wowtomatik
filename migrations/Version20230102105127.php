<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102105127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guilds_instances (guilds_id INT NOT NULL, instances_id INT NOT NULL, INDEX IDX_33BFE3CBD79B63FD (guilds_id), INDEX IDX_33BFE3CB844D808E (instances_id), PRIMARY KEY(guilds_id, instances_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guilds_instances ADD CONSTRAINT FK_33BFE3CBD79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guilds_instances ADD CONSTRAINT FK_33BFE3CB844D808E FOREIGN KEY (instances_id) REFERENCES instances (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guilds_instances DROP FOREIGN KEY FK_33BFE3CBD79B63FD');
        $this->addSql('ALTER TABLE guilds_instances DROP FOREIGN KEY FK_33BFE3CB844D808E');
        $this->addSql('DROP TABLE guilds_instances');
    }
}
