<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221092718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFB83297E7');
        $this->addSql('DROP INDEX IDX_C509E4FFB83297E7 ON chambre');
        $this->addSql('ALTER TABLE chambre DROP reservation_id');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2B83297E7');
        $this->addSql('DROP INDEX IDX_E19D9AD2B83297E7 ON service');
        $this->addSql('ALTER TABLE service DROP reservation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre ADD reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FFB83297E7 ON chambre (reservation_id)');
        $this->addSql('ALTER TABLE service ADD reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD2B83297E7 ON service (reservation_id)');
    }
}
