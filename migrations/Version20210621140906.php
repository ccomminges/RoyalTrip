<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621140906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD voyage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D68C9E5AF ON commande (voyage_id)');
        $this->addSql('ALTER TABLE detail_commande CHANGE quantite quantite INT DEFAULT NULL, CHANGE nb_pers_plus12 nb_pers_plus12 INT DEFAULT NULL, CHANGE nb_pers_moins12 nb_pers_moins12 INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D68C9E5AF');
        $this->addSql('DROP INDEX IDX_6EEAA67D68C9E5AF ON commande');
        $this->addSql('ALTER TABLE commande DROP voyage_id');
        $this->addSql('ALTER TABLE detail_commande CHANGE quantite quantite INT NOT NULL, CHANGE nb_pers_plus12 nb_pers_plus12 INT NOT NULL, CHANGE nb_pers_moins12 nb_pers_moins12 INT NOT NULL');
    }
}
