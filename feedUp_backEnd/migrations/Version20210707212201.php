<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707212201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_evenement (utilisateur_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_6B889D32FB88E14F (utilisateur_id), INDEX IDX_6B889D32FD02F13 (evenement_id), PRIMARY KEY(utilisateur_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_evenement ADD CONSTRAINT FK_6B889D32FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_evenement ADD CONSTRAINT FK_6B889D32FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE evenement_utilisateur');
        $this->addSql('ALTER TABLE commentaire ADD evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCFD02F13 ON commentaire (evenement_id)');
        $this->addSql('ALTER TABLE evenement CHANGE eduree eduree DATETIME NOT NULL');
        $this->addSql('ALTER TABLE experience ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_590C103FB88E14F ON experience (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_utilisateur (evenement_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_8C897598FD02F13 (evenement_id), INDEX IDX_8C897598FB88E14F (utilisateur_id), PRIMARY KEY(evenement_id, utilisateur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement_utilisateur ADD CONSTRAINT FK_8C897598FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_utilisateur ADD CONSTRAINT FK_8C897598FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE utilisateur_evenement');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFD02F13');
        $this->addSql('DROP INDEX IDX_67F068BCFD02F13 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP evenement_id');
        $this->addSql('ALTER TABLE evenement CHANGE eduree eduree VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:dateinterval)\'');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103FB88E14F');
        $this->addSql('DROP INDEX IDX_590C103FB88E14F ON experience');
        $this->addSql('ALTER TABLE experience DROP utilisateur_id');
    }
}
