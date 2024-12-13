<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211100146 extends AbstractMigration
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
        $this->addSql('ALTER TABLE user_cat DROP FOREIGN KEY FK_75482223A76ED395');
        $this->addSql('ALTER TABLE user_cat DROP FOREIGN KEY FK_75482223E6ADA943');
        $this->addSql('DROP TABLE user_cat');
        $this->addSql('ALTER TABLE user ADD couple_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F66468CA FOREIGN KEY (couple_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F66468CA ON user (couple_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_cat (user_id INT NOT NULL, cat_id INT NOT NULL, INDEX IDX_75482223A76ED395 (user_id), INDEX IDX_75482223E6ADA943 (cat_id), PRIMARY KEY(user_id, cat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_cat ADD CONSTRAINT FK_75482223A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_cat ADD CONSTRAINT FK_75482223E6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cat_user DROP FOREIGN KEY FK_90A021F8E6ADA943');
        $this->addSql('ALTER TABLE cat_user DROP FOREIGN KEY FK_90A021F8A76ED395');
        $this->addSql('DROP TABLE cat_user');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F66468CA');
        $this->addSql('DROP INDEX UNIQ_8D93D649F66468CA ON user');
        $this->addSql('ALTER TABLE user DROP couple_id');
    }
}
