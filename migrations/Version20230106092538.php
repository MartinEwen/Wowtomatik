<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106092538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guilds_boss DROP FOREIGN KEY FK_223A0825261FB672');
        $this->addSql('ALTER TABLE guilds_boss DROP FOREIGN KEY FK_223A0825D79B63FD');
        $this->addSql('DROP TABLE guilds_boss');
        $this->addSql('ALTER TABLE user CHANGE pseudo pseudo VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guilds_boss (guilds_id INT NOT NULL, boss_id INT NOT NULL, INDEX IDX_223A0825D79B63FD (guilds_id), INDEX IDX_223A0825261FB672 (boss_id), PRIMARY KEY(guilds_id, boss_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE guilds_boss ADD CONSTRAINT FK_223A0825261FB672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guilds_boss ADD CONSTRAINT FK_223A0825D79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE pseudo pseudo VARCHAR(50) DEFAULT NULL');
    }
}
