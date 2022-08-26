<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823051506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, titre_projet VARCHAR(255) NOT NULL, entrepreneur VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, date_lancement DATETIME NOT NULL, motivation LONGTEXT DEFAULT NULL, principaux_interet LONGTEXT DEFAULT NULL, activites VARCHAR(255) DEFAULT NULL, cible VARCHAR(255) DEFAULT NULL, fournisseur VARCHAR(255) DEFAULT NULL, concurent VARCHAR(255) DEFAULT NULL, strategie_commercial VARCHAR(255) DEFAULT NULL, objectif_commerciaux VARCHAR(255) DEFAULT NULL, partie_prenante VARCHAR(255) DEFAULT NULL, coup_investissement VARCHAR(255) DEFAULT NULL, capital_social VARCHAR(255) DEFAULT NULL, credit_a_solicite VARCHAR(255) DEFAULT NULL, benefice_escompte VARCHAR(255) DEFAULT NULL, nb_employer VARCHAR(255) DEFAULT NULL, apport_personnel VARCHAR(255) DEFAULT NULL, delai_retour_investissement VARCHAR(255) DEFAULT NULL, quantite_produit VARCHAR(255) DEFAULT NULL, rentabilite_prevu VARCHAR(255) DEFAULT NULL, forme_juridique VARCHAR(255) DEFAULT NULL, information_complementaire LONGTEXT DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, reponse VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', statut VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
