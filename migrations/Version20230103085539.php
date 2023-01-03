<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103085539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boss (id INT AUTO_INCREMENT NOT NULL, name_boss VARCHAR(255) DEFAULT NULL, img_boss VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, guilds_id INT DEFAULT NULL, name_character VARCHAR(50) DEFAULT NULL, lvl_character SMALLINT DEFAULT NULL, class_character VARCHAR(50) DEFAULT NULL, spe_character1 VARCHAR(50) DEFAULT NULL, gear_score_spe1 SMALLINT DEFAULT NULL, spe_character2 VARCHAR(50) DEFAULT NULL, gear_score_spe2 SMALLINT DEFAULT NULL, role_guild VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_3A29410EEF8A8E76 (name_character), INDEX IDX_3A29410EA76ED395 (user_id), INDEX IDX_3A29410ED79B63FD (guilds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters_events (characters_id INT NOT NULL, events_id INT NOT NULL, INDEX IDX_6DC847EDC70F0E28 (characters_id), INDEX IDX_6DC847ED9D6A1065 (events_id), PRIMARY KEY(characters_id, events_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, guilds_id INT DEFAULT NULL, name_event VARCHAR(255) DEFAULT NULL, name_user_creator VARCHAR(50) DEFAULT NULL, date_event DATETIME DEFAULT NULL, number_of_tank SMALLINT DEFAULT NULL, number_of_heal SMALLINT DEFAULT NULL, number_of_dps SMALLINT DEFAULT NULL, INDEX IDX_5387574AD79B63FD (guilds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilds (id INT AUTO_INCREMENT NOT NULL, name_guild VARCHAR(50) DEFAULT NULL, number_of_member INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilds_instances (guilds_id INT NOT NULL, instances_id INT NOT NULL, INDEX IDX_33BFE3CBD79B63FD (guilds_id), INDEX IDX_33BFE3CB844D808E (instances_id), PRIMARY KEY(guilds_id, instances_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilds_boss (guilds_id INT NOT NULL, boss_id INT NOT NULL, INDEX IDX_223A0825D79B63FD (guilds_id), INDEX IDX_223A0825261FB672 (boss_id), PRIMARY KEY(guilds_id, boss_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instances (id INT AUTO_INCREMENT NOT NULL, name_instance VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instances_boss (instances_id INT NOT NULL, boss_id INT NOT NULL, INDEX IDX_1F2BC204844D808E (instances_id), INDEX IDX_1F2BC204261FB672 (boss_id), PRIMARY KEY(instances_id, boss_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410ED79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id)');
        $this->addSql('ALTER TABLE characters_events ADD CONSTRAINT FK_6DC847EDC70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characters_events ADD CONSTRAINT FK_6DC847ED9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AD79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id)');
        $this->addSql('ALTER TABLE guilds_instances ADD CONSTRAINT FK_33BFE3CBD79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guilds_instances ADD CONSTRAINT FK_33BFE3CB844D808E FOREIGN KEY (instances_id) REFERENCES instances (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guilds_boss ADD CONSTRAINT FK_223A0825D79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guilds_boss ADD CONSTRAINT FK_223A0825261FB672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instances_boss ADD CONSTRAINT FK_1F2BC204844D808E FOREIGN KEY (instances_id) REFERENCES instances (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instances_boss ADD CONSTRAINT FK_1F2BC204261FB672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EA76ED395');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410ED79B63FD');
        $this->addSql('ALTER TABLE characters_events DROP FOREIGN KEY FK_6DC847EDC70F0E28');
        $this->addSql('ALTER TABLE characters_events DROP FOREIGN KEY FK_6DC847ED9D6A1065');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AD79B63FD');
        $this->addSql('ALTER TABLE guilds_instances DROP FOREIGN KEY FK_33BFE3CBD79B63FD');
        $this->addSql('ALTER TABLE guilds_instances DROP FOREIGN KEY FK_33BFE3CB844D808E');
        $this->addSql('ALTER TABLE guilds_boss DROP FOREIGN KEY FK_223A0825D79B63FD');
        $this->addSql('ALTER TABLE guilds_boss DROP FOREIGN KEY FK_223A0825261FB672');
        $this->addSql('ALTER TABLE instances_boss DROP FOREIGN KEY FK_1F2BC204844D808E');
        $this->addSql('ALTER TABLE instances_boss DROP FOREIGN KEY FK_1F2BC204261FB672');
        $this->addSql('DROP TABLE boss');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE characters_events');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE guilds');
        $this->addSql('DROP TABLE guilds_instances');
        $this->addSql('DROP TABLE guilds_boss');
        $this->addSql('DROP TABLE instances');
        $this->addSql('DROP TABLE instances_boss');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
