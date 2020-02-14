<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212234659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE calendrier (id INT AUTO_INCREMENT NOT NULL, rencontres_id INT NOT NULL, cal_date DATETIME DEFAULT NULL, journee INT NOT NULL, UNIQUE INDEX UNIQ_B2753CB9F471D97B (rencontres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classement (id INT AUTO_INCREMENT NOT NULL, equipes_id INT NOT NULL, victoires INT NOT NULL, nuls INT NOT NULL, defaites INT NOT NULL, dif INT NOT NULL, points INT NOT NULL, joues INT DEFAULT NULL, totbuts INT DEFAULT NULL, UNIQUE INDEX UNIQ_55EE9D6D737800BA (equipes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE description (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, nav VARCHAR(255) NOT NULL, journee INT NOT NULL, saison VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entraineur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, stades_id INT NOT NULL, entraineurs_id INT NOT NULL, nom VARCHAR(255) NOT NULL, surnom VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, president VARCHAR(255) NOT NULL, fondation VARCHAR(255) NOT NULL, site VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_2449BA158C195A4 (stades_id), UNIQUE INDEX UNIQ_2449BA1546AFAA23 (entraineurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joue_rencontre (id INT AUTO_INCREMENT NOT NULL, rencontres_id INT NOT NULL, joueurs_id INT NOT NULL, statsjoueurs_id INT NOT NULL, tit_rem VARCHAR(255) NOT NULL, INDEX IDX_D3A21306F471D97B (rencontres_id), INDEX IDX_D3A21306A3DC7281 (joueurs_id), UNIQUE INDEX UNIQ_D3A21306E08E1839 (statsjoueurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, equipes_id INT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, poids INT NOT NULL, nationalite VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_FD71A9C5737800BA (equipes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, stades_id INT NOT NULL, equipes_d_id INT NOT NULL, equipes_e_id INT NOT NULL, stats_eq_d_id INT DEFAULT NULL, stats_eq_e_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_460C35ED8C195A4 (stades_id), INDEX IDX_460C35ED7B4780B6 (equipes_d_id), INDEX IDX_460C35EDC3FBE7D3 (equipes_e_id), UNIQUE INDEX UNIQ_460C35ED8A210769 (stats_eq_d_id), UNIQUE INDEX UNIQ_460C35ED329D600C (stats_eq_e_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stade (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, capacite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_equipe (id INT AUTO_INCREMENT NOT NULL, equipes_id INT NOT NULL, rencontres_id INT NOT NULL, dispositif VARCHAR(255) NOT NULL, buts INT NOT NULL, possession VARCHAR(255) NOT NULL, tirs_c INT NOT NULL, tirs INT NOT NULL, corners INT NOT NULL, coups_francs INT NOT NULL, cartons_jaunes INT NOT NULL, cartons_rouges INT NOT NULL, fautes INT NOT NULL, INDEX IDX_97595D16737800BA (equipes_id), INDEX IDX_97595D16F471D97B (rencontres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_joueur (id INT AUTO_INCREMENT NOT NULL, joueurs_id INT NOT NULL, num INT NOT NULL, min INT NOT NULL, buts INT NOT NULL, pass_d INT NOT NULL, tirs_c INT NOT NULL, tirs INT NOT NULL, passes INT NOT NULL, tacles INT NOT NULL, fautes INT NOT NULL, cartons_jaunes INT NOT NULL, cartons_rouges INT NOT NULL, disponible VARCHAR(255) NOT NULL, INDEX IDX_4E614EC6A3DC7281 (joueurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB9F471D97B FOREIGN KEY (rencontres_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE classement ADD CONSTRAINT FK_55EE9D6D737800BA FOREIGN KEY (equipes_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA158C195A4 FOREIGN KEY (stades_id) REFERENCES stade (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1546AFAA23 FOREIGN KEY (entraineurs_id) REFERENCES entraineur (id)');
        $this->addSql('ALTER TABLE joue_rencontre ADD CONSTRAINT FK_D3A21306F471D97B FOREIGN KEY (rencontres_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE joue_rencontre ADD CONSTRAINT FK_D3A21306A3DC7281 FOREIGN KEY (joueurs_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE joue_rencontre ADD CONSTRAINT FK_D3A21306E08E1839 FOREIGN KEY (statsjoueurs_id) REFERENCES stats_joueur (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5737800BA FOREIGN KEY (equipes_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED8C195A4 FOREIGN KEY (stades_id) REFERENCES stade (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED7B4780B6 FOREIGN KEY (equipes_d_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDC3FBE7D3 FOREIGN KEY (equipes_e_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED8A210769 FOREIGN KEY (stats_eq_d_id) REFERENCES stats_equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED329D600C FOREIGN KEY (stats_eq_e_id) REFERENCES stats_equipe (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stats_equipe ADD CONSTRAINT FK_97595D16737800BA FOREIGN KEY (equipes_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE stats_equipe ADD CONSTRAINT FK_97595D16F471D97B FOREIGN KEY (rencontres_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE stats_joueur ADD CONSTRAINT FK_4E614EC6A3DC7281 FOREIGN KEY (joueurs_id) REFERENCES joueur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1546AFAA23');
        $this->addSql('ALTER TABLE classement DROP FOREIGN KEY FK_55EE9D6D737800BA');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5737800BA');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED7B4780B6');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDC3FBE7D3');
        $this->addSql('ALTER TABLE stats_equipe DROP FOREIGN KEY FK_97595D16737800BA');
        $this->addSql('ALTER TABLE joue_rencontre DROP FOREIGN KEY FK_D3A21306A3DC7281');
        $this->addSql('ALTER TABLE stats_joueur DROP FOREIGN KEY FK_4E614EC6A3DC7281');
        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB9F471D97B');
        $this->addSql('ALTER TABLE joue_rencontre DROP FOREIGN KEY FK_D3A21306F471D97B');
        $this->addSql('ALTER TABLE stats_equipe DROP FOREIGN KEY FK_97595D16F471D97B');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA158C195A4');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED8C195A4');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED8A210769');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED329D600C');
        $this->addSql('ALTER TABLE joue_rencontre DROP FOREIGN KEY FK_D3A21306E08E1839');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('DROP TABLE classement');
        $this->addSql('DROP TABLE description');
        $this->addSql('DROP TABLE entraineur');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joue_rencontre');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE stade');
        $this->addSql('DROP TABLE stats_equipe');
        $this->addSql('DROP TABLE stats_joueur');
        $this->addSql('DROP TABLE user');
    }
}
