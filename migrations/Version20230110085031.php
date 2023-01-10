<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110085031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boss (id INT AUTO_INCREMENT NOT NULL, instance_id INT DEFAULT NULL, name_boss VARCHAR(255) DEFAULT NULL, img_boss VARCHAR(255) DEFAULT NULL, INDEX IDX_3EFE663A3A51721D (instance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, guilds_id INT DEFAULT NULL, race_id INT NOT NULL, classe_id INT NOT NULL, name_character VARCHAR(50) DEFAULT NULL, lvl_character SMALLINT DEFAULT NULL, gear_score_spe1 SMALLINT DEFAULT NULL, gear_score_spe2 SMALLINT DEFAULT NULL, role_guild VARCHAR(50) DEFAULT NULL, INDEX IDX_3A29410EA76ED395 (user_id), INDEX IDX_3A29410ED79B63FD (guilds_id), INDEX IDX_3A29410E6E59D40D (race_id), INDEX IDX_3A29410E8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_race (classe_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_C47CCE498F5EA509 (classe_id), INDEX IDX_C47CCE496E59D40D (race_id), PRIMARY KEY(classe_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilds (id INT AUTO_INCREMENT NOT NULL, name_guild VARCHAR(50) DEFAULT NULL, number_of_member INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instances (id INT AUTO_INCREMENT NOT NULL, name_instance VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, agree_terms TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boss ADD CONSTRAINT FK_3EFE663A3A51721D FOREIGN KEY (instance_id) REFERENCES instances (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410ED79B63FD FOREIGN KEY (guilds_id) REFERENCES guilds (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE classe_race ADD CONSTRAINT FK_C47CCE498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_race ADD CONSTRAINT FK_C47CCE496E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boss DROP FOREIGN KEY FK_3EFE663A3A51721D');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EA76ED395');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410ED79B63FD');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E6E59D40D');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E8F5EA509');
        $this->addSql('ALTER TABLE classe_race DROP FOREIGN KEY FK_C47CCE498F5EA509');
        $this->addSql('ALTER TABLE classe_race DROP FOREIGN KEY FK_C47CCE496E59D40D');
        $this->addSql('DROP TABLE boss');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_race');
        $this->addSql('DROP TABLE guilds');
        $this->addSql('DROP TABLE instances');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
