<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211125545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adopt (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cat_id INT DEFAULT NULL, date_adoption DATE NOT NULL, INDEX IDX_EDE8897AA76ED395 (user_id), INDEX IDX_EDE8897AE6ADA943 (cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adopt ADD CONSTRAINT FK_EDE8897AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adopt ADD CONSTRAINT FK_EDE8897AE6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adopt DROP FOREIGN KEY FK_EDE8897AA76ED395');
        $this->addSql('ALTER TABLE adopt DROP FOREIGN KEY FK_EDE8897AE6ADA943');
        $this->addSql('DROP TABLE adopt');
    }
}
