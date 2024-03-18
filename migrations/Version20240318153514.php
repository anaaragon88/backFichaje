<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240318153514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrada (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, fecha_publicacion DATETIME NOT NULL, comentario VARCHAR(100) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, locacion VARCHAR(100) DEFAULT NULL, INDEX IDX_C949A274A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salida (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, fecha_publicacion DATETIME NOT NULL, comentario VARCHAR(100) DEFAULT NULL, locacion VARCHAR(100) DEFAULT NULL, INDEX IDX_95F4C748A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A274A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE salida ADD CONSTRAINT FK_95F4C748A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sign_in DROP FOREIGN KEY FK_E629950B4D33EB4');
        $this->addSql('ALTER TABLE sign_out DROP FOREIGN KEY FK_BFE51D9D187B4DB0');
        $this->addSql('DROP TABLE sign_in');
        $this->addSql('DROP TABLE sign_out');
        $this->addSql('ALTER TABLE user ADD horas_semanales VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sign_in (id INT AUTO_INCREMENT NOT NULL, signinuser_id INT DEFAULT NULL, hoursignin LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', localitation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, comment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, updated TINYINT(1) NOT NULL, INDEX IDX_E629950B4D33EB4 (signinuser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sign_out (id INT AUTO_INCREMENT NOT NULL, signoutuser_id INT DEFAULT NULL, hoursignout LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', localitation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, comment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, updated TINYINT(1) NOT NULL, INDEX IDX_BFE51D9D187B4DB0 (signoutuser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sign_in ADD CONSTRAINT FK_E629950B4D33EB4 FOREIGN KEY (signinuser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sign_out ADD CONSTRAINT FK_BFE51D9D187B4DB0 FOREIGN KEY (signoutuser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entrada DROP FOREIGN KEY FK_C949A274A76ED395');
        $this->addSql('ALTER TABLE salida DROP FOREIGN KEY FK_95F4C748A76ED395');
        $this->addSql('DROP TABLE entrada');
        $this->addSql('DROP TABLE salida');
        $this->addSql('ALTER TABLE user DROP horas_semanales');
    }
}
