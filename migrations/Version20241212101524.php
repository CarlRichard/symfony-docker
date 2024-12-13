<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212101524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B98413256915B');
        $this->addSql('DROP INDEX IDX_D73B98413256915B ON technique');
        $this->addSql('ALTER TABLE technique CHANGE classe relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B98413256915B FOREIGN KEY (relation_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_D73B98413256915B ON technique (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B98413256915B');
        $this->addSql('DROP INDEX IDX_D73B98413256915B ON technique');
        $this->addSql('ALTER TABLE technique CHANGE relation_id classe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B98413256915B FOREIGN KEY (classe) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D73B98413256915B ON technique (classe)');
    }
}
