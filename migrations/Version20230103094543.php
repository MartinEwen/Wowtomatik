<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103094543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters_events DROP FOREIGN KEY FK_6DC847ED9D6A1065');
        $this->addSql('ALTER TABLE characters_events DROP FOREIGN KEY FK_6DC847EDC70F0E28');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AD79B63FD');
        $this->addSql('DROP TABLE characters_events');
        $this->addSql('DROP TABLE events');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characters_events (characters_id INT NOT NULL, events_id INT NOT NULL, INDEX IDX_6DC847ED9D6A1065 (events_id), INDEX IDX_6DC847EDC70F0E28 (characters_id), PRIMARY KEY(characters_id, events_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, guilds_id INT DEFAULT NULL, name_event VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, name_user_creator VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_event DATETIME DEFAULT NULL, number_of_tank SMALLINT DEFAULT NULL, number_of_heal SMALLINT DEFAULT NULL, number_of_dps SMALLINT DEFAULT NULL, INDEX IDX_5387574AD79B63FD (guilds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE characters_events ADD CONSTRAINT FK_6DC847ED9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characters_events ADD CONSTRAINT FK_6DC847EDC70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AD79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
