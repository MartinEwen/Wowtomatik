<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102105303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instances_boss (instances_id INT NOT NULL, boss_id INT NOT NULL, INDEX IDX_1F2BC204844D808E (instances_id), INDEX IDX_1F2BC204261FB672 (boss_id), PRIMARY KEY(instances_id, boss_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instances_boss ADD CONSTRAINT FK_1F2BC204844D808E FOREIGN KEY (instances_id) REFERENCES instances (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instances_boss ADD CONSTRAINT FK_1F2BC204261FB672 FOREIGN KEY (boss_id) REFERENCES boss (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE instances_boss DROP FOREIGN KEY FK_1F2BC204844D808E');
        $this->addSql('ALTER TABLE instances_boss DROP FOREIGN KEY FK_1F2BC204261FB672');
        $this->addSql('DROP TABLE instances_boss');
    }
}
