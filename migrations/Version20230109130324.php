<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109130324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe_race (classe_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_C47CCE498F5EA509 (classe_id), INDEX IDX_C47CCE496E59D40D (race_id), PRIMARY KEY(classe_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_race ADD CONSTRAINT FK_C47CCE498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_race ADD CONSTRAINT FK_C47CCE496E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characters ADD race_id INT NOT NULL');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('CREATE INDEX IDX_3A29410E6E59D40D ON characters (race_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E6E59D40D');
        $this->addSql('ALTER TABLE classe_race DROP FOREIGN KEY FK_C47CCE498F5EA509');
        $this->addSql('ALTER TABLE classe_race DROP FOREIGN KEY FK_C47CCE496E59D40D');
        $this->addSql('DROP TABLE classe_race');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP INDEX IDX_3A29410E6E59D40D ON characters');
        $this->addSql('ALTER TABLE characters DROP race_id');
    }
}
