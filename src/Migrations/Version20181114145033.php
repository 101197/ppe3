<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181114145033 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (id_adresse INT AUTO_INCREMENT NOT NULL, id_client INT DEFAULT NULL, voie VARCHAR(100) NOT NULL, complement VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(10) NOT NULL, ville VARCHAR(50) NOT NULL, INDEX FK_adresse_idClient (id_client), PRIMARY KEY(id_adresse)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id_avis INT AUTO_INCREMENT NOT NULL, id_client INT DEFAULT NULL, id_produit INT DEFAULT NULL, date_avis DATETIME NOT NULL, valeur VARCHAR(255) NOT NULL, INDEX FK_avis_idClient (id_client), INDEX FK_avis_idProduit (id_produit), PRIMARY KEY(id_avis)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id_categorie INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id_categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id_client INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(20) NOT NULL, email VARCHAR(100) NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, telephone VARCHAR(13) DEFAULT NULL, avatar_url VARCHAR(25) NOT NULL, date_creation DATETIME NOT NULL, confirme TINYINT(1) NOT NULL, token VARCHAR(1) NOT NULL, PRIMARY KEY(id_client)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id_commande INT AUTO_INCREMENT NOT NULL, id_client INT DEFAULT NULL, id_adresse INT DEFAULT NULL, date_commande DATETIME NOT NULL, total_ht NUMERIC(10, 0) DEFAULT NULL, frais_port_ht NUMERIC(10, 0) DEFAULT NULL, taxe_moment_commande NUMERIC(15, 2) NOT NULL, INDEX FK_commande_idClient (id_client), INDEX FK_commande_idAdresse (id_adresse), PRIMARY KEY(id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id_commentaire INT AUTO_INCREMENT NOT NULL, id_client INT DEFAULT NULL, id_produit INT DEFAULT NULL, date_commentaire DATETIME NOT NULL, titre_commentaire VARCHAR(100) NOT NULL, contenu_commentaire VARCHAR(1000) NOT NULL, INDEX FK_commentaire_idClient (id_client), INDEX FK_commentaire_idProduit (id_produit), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenu_commande (id_contenu_commande INT AUTO_INCREMENT NOT NULL, id_taux_taxe INT DEFAULT NULL, id_commande INT DEFAULT NULL, id_produit INT DEFAULT NULL, prix_unitaireHT NUMERIC(15, 2) NOT NULL, Quantite_Contenu INT NOT NULL, remise NUMERIC(10, 0) DEFAULT NULL, INDEX FK_contenu_commande_idTauxTaxe (id_taux_taxe), INDEX FK_contenu_commande_idCommande (id_commande), INDEX FK_contenu_commande_idProduit (id_produit), PRIMARY KEY(id_contenu_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_panier (id_client INT NOT NULL, id_produit INT NOT NULL, quantite INT NOT NULL, INDEX FK_ligne_panier_idClient (id_client), INDEX FK_ligne_panier_idProduit (id_produit), PRIMARY KEY(id_client, id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_produit (id_photo_produit INT AUTO_INCREMENT NOT NULL, id_produit INT DEFAULT NULL, nom_image VARCHAR(100) DEFAULT NULL, INDEX FK_photo_produit_idProduit (id_produit), PRIMARY KEY(id_photo_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id_produit INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, prix_unitaire_ht NUMERIC(15, 2) NOT NULL, reference VARCHAR(255) NOT NULL, quantite_produit INT NOT NULL, description_produit VARCHAR(1000) DEFAULT NULL, INDEX FK_produit_idCategorie (id_categorie), PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxes (id_taux_taxe INT AUTO_INCREMENT NOT NULL, taux NUMERIC(15, 2) NOT NULL, PRIMARY KEY(id_taux_taxe)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816E173B1B8 FOREIGN KEY (id_client) REFERENCES client (id_client)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0E173B1B8 FOREIGN KEY (id_client) REFERENCES client (id_client)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DE173B1B8 FOREIGN KEY (id_client) REFERENCES client (id_client)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D1DC2A166 FOREIGN KEY (id_adresse) REFERENCES adresse (id_adresse)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCE173B1B8 FOREIGN KEY (id_client) REFERENCES client (id_client)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCF7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE contenu_commande ADD CONSTRAINT FK_D39F27AC432642BA FOREIGN KEY (id_taux_taxe) REFERENCES taxes (id_taux_taxe)');
        $this->addSql('ALTER TABLE contenu_commande ADD CONSTRAINT FK_D39F27AC3E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_commande)');
        $this->addSql('ALTER TABLE contenu_commande ADD CONSTRAINT FK_D39F27ACF7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE ligne_panier ADD CONSTRAINT FK_21691B4E173B1B8 FOREIGN KEY (id_client) REFERENCES client (id_client)');
        $this->addSql('ALTER TABLE ligne_panier ADD CONSTRAINT FK_21691B4F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE photo_produit ADD CONSTRAINT FK_1C45FBAAF7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id_categorie)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D1DC2A166');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C9486A13');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816E173B1B8');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0E173B1B8');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DE173B1B8');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCE173B1B8');
        $this->addSql('ALTER TABLE ligne_panier DROP FOREIGN KEY FK_21691B4E173B1B8');
        $this->addSql('ALTER TABLE contenu_commande DROP FOREIGN KEY FK_D39F27AC3E314AE8');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F7384557');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCF7384557');
        $this->addSql('ALTER TABLE contenu_commande DROP FOREIGN KEY FK_D39F27ACF7384557');
        $this->addSql('ALTER TABLE ligne_panier DROP FOREIGN KEY FK_21691B4F7384557');
        $this->addSql('ALTER TABLE photo_produit DROP FOREIGN KEY FK_1C45FBAAF7384557');
        $this->addSql('ALTER TABLE contenu_commande DROP FOREIGN KEY FK_D39F27AC432642BA');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE contenu_commande');
        $this->addSql('DROP TABLE ligne_panier');
        $this->addSql('DROP TABLE photo_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE taxes');
    }
}
