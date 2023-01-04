<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103152055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boss ADD instance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boss ADD CONSTRAINT FK_3EFE663A3A51721D FOREIGN KEY (instance_id) REFERENCES instances (id)');
        $this->addSql('CREATE INDEX IDX_3EFE663A3A51721D ON boss (instance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boss DROP FOREIGN KEY FK_3EFE663A3A51721D');
        $this->addSql('DROP INDEX IDX_3EFE663A3A51721D ON boss');
        $this->addSql('ALTER TABLE boss DROP instance_id');
    }
}
