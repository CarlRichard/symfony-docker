<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211124526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cat_user (cat_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_90A021F8E6ADA943 (cat_id), INDEX IDX_90A021F8A76ED395 (user_id), PRIMARY KEY(cat_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cat_user ADD CONSTRAINT FK_90A021F8E6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cat_user ADD CONSTRAINT FK_90A021F8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat_user DROP FOREIGN KEY FK_90A021F8E6ADA943');
        $this->addSql('ALTER TABLE cat_user DROP FOREIGN KEY FK_90A021F8A76ED395');
        $this->addSql('DROP TABLE cat_user');
    }
}
