<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211150137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, element VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, pv INT NOT NULL, attaque INT NOT NULL, defense INT NOT NULL, vitesse INT NOT NULL, UNIQUE INDEX UNIQ_51CE6E868F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_monstre (hero_id INT NOT NULL, monstre_id INT NOT NULL, INDEX IDX_B60A048245B0BCD (hero_id), INDEX IDX_B60A0482DAF13697 (monstre_id), PRIMARY KEY(hero_id, monstre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monstre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pv INT NOT NULL, attaque INT NOT NULL, defense INT NOT NULL, vitesse INT NOT NULL, element VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objet (id INT AUTO_INCREMENT NOT NULL, hero_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, effet LONGTEXT NOT NULL, INDEX IDX_46CD4C3845B0BCD (hero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technique (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, element VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, effet VARCHAR(255) DEFAULT NULL, INDEX IDX_D73B98413256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technique_monstre (technique_id INT NOT NULL, monstre_id INT NOT NULL, INDEX IDX_BA3E88D71F8ACB26 (technique_id), INDEX IDX_BA3E88D7DAF13697 (monstre_id), PRIMARY KEY(technique_id, monstre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hero ADD CONSTRAINT FK_51CE6E868F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE hero_monstre ADD CONSTRAINT FK_B60A048245B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_monstre ADD CONSTRAINT FK_B60A0482DAF13697 FOREIGN KEY (monstre_id) REFERENCES monstre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C3845B0BCD FOREIGN KEY (hero_id) REFERENCES hero (id)');
        $this->addSql('ALTER TABLE technique ADD CONSTRAINT FK_D73B98413256915B FOREIGN KEY (relation_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE technique_monstre ADD CONSTRAINT FK_BA3E88D71F8ACB26 FOREIGN KEY (technique_id) REFERENCES technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technique_monstre ADD CONSTRAINT FK_BA3E88D7DAF13697 FOREIGN KEY (monstre_id) REFERENCES monstre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hero DROP FOREIGN KEY FK_51CE6E868F5EA509');
        $this->addSql('ALTER TABLE hero_monstre DROP FOREIGN KEY FK_B60A048245B0BCD');
        $this->addSql('ALTER TABLE hero_monstre DROP FOREIGN KEY FK_B60A0482DAF13697');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C3845B0BCD');
        $this->addSql('ALTER TABLE technique DROP FOREIGN KEY FK_D73B98413256915B');
        $this->addSql('ALTER TABLE technique_monstre DROP FOREIGN KEY FK_BA3E88D71F8ACB26');
        $this->addSql('ALTER TABLE technique_monstre DROP FOREIGN KEY FK_BA3E88D7DAF13697');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE hero');
        $this->addSql('DROP TABLE hero_monstre');
        $this->addSql('DROP TABLE monstre');
        $this->addSql('DROP TABLE objet');
        $this->addSql('DROP TABLE technique');
        $this->addSql('DROP TABLE technique_monstre');
    }
}
