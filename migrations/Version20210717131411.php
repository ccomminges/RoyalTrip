<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717131411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, voyage_id INT DEFAULT NULL, heure_rdv DATETIME DEFAULT NULL, date_rdv DATE DEFAULT NULL, rdv_presentiel TINYINT(1) DEFAULT NULL, date_creation DATE NOT NULL, etat INT NOT NULL, reference VARCHAR(255) NOT NULL, stripe_session_id VARCHAR(255) DEFAULT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D68C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE client (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, num_cb VARCHAR(255) NOT NULL, reservation TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conseiller (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, questionnaire LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_18C69F97E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, voyage_id INT DEFAULT NULL, pays VARCHAR(255) NOT NULL, continent VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, region VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3EC63EAA68C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, voyage_nom VARCHAR(255) NOT NULL, quantite INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, nb_pers_plus12 INT DEFAULT NULL, nb_pers_moins12 INT DEFAULT NULL, reduction_moins12 DOUBLE PRECISION DEFAULT NULL, INDEX IDX_98344FA682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, date_creation DATE NOT NULL, date_limite DATE NOT NULL, statut_dossier VARCHAR(255) NOT NULL, nb_place_reserve INT NOT NULL, annulation TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_3D48E03719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formule (id INT AUTO_INCREMENT NOT NULL, voyage_id INT DEFAULT NULL, avion TINYINT(1) NOT NULL, hotel TINYINT(1) NOT NULL, voiture TINYINT(1) NOT NULL, guide TINYINT(1) NOT NULL, photo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_605C9C9868C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, voyage_id INT DEFAULT NULL, heb_seul TINYINT(1) NOT NULL, petit_dej TINYINT(1) NOT NULL, demi_pension TINYINT(1) NOT NULL, pension_complete TINYINT(1) NOT NULL, photo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_4852DD9C68C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, conseiller_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, civilite VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_716970921AC39A0D (conseiller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_mdp (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_AB49DB6A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, formule_id INT DEFAULT NULL, loueur VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E9E2810F2A68F4D1 (formule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, date_depart DATE NOT NULL, date_retour DATE NOT NULL, tarif DOUBLE PRECISION NOT NULL, nb_place INT NOT NULL, disponibilite TINYINT(1) NOT NULL, assurance TINYINT(1) NOT NULL, statut_voyage VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, duree INT NOT NULL, description LONGTEXT NOT NULL, reduction VARCHAR(255) DEFAULT NULL, aime_par_cons LONGTEXT DEFAULT NULL, services_propose LONGTEXT DEFAULT NULL, tarif_moins12 DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_participants (voyage_id INT NOT NULL, participants_id INT NOT NULL, INDEX IDX_4982A6CE68C9E5AF (voyage_id), INDEX IDX_4982A6CE838709D5 (participants_id), PRIMARY KEY(voyage_id, participants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES participants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAA68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E03719EB6921 FOREIGN KEY (client_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C9868C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_716970921AC39A0D FOREIGN KEY (conseiller_id) REFERENCES conseiller (id)');
        $this->addSql('ALTER TABLE reset_mdp ADD CONSTRAINT FK_AB49DB6A19EB6921 FOREIGN KEY (client_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F2A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id)');
        $this->addSql('ALTER TABLE voyage_participants ADD CONSTRAINT FK_4982A6CE68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_participants ADD CONSTRAINT FK_4982A6CE838709D5 FOREIGN KEY (participants_id) REFERENCES participants (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA682EA2E54');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_716970921AC39A0D');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F2A68F4D1');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E03719EB6921');
        $this->addSql('ALTER TABLE reset_mdp DROP FOREIGN KEY FK_AB49DB6A19EB6921');
        $this->addSql('ALTER TABLE voyage_participants DROP FOREIGN KEY FK_4982A6CE838709D5');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D68C9E5AF');
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAA68C9E5AF');
        $this->addSql('ALTER TABLE formule DROP FOREIGN KEY FK_605C9C9868C9E5AF');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C68C9E5AF');
        $this->addSql('ALTER TABLE voyage_participants DROP FOREIGN KEY FK_4982A6CE68C9E5AF');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE conseiller');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE participants');
        $this->addSql('DROP TABLE reset_mdp');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_participants');
    }
}
