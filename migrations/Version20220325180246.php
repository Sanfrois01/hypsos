<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325180246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_hotel (admin_id INT NOT NULL, hotel_id INT NOT NULL, INDEX IDX_A379A523642B8210 (admin_id), INDEX IDX_A379A5233243BB18 (hotel_id), PRIMARY KEY(admin_id, hotel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_hotel ADD CONSTRAINT FK_A379A523642B8210 FOREIGN KEY (admin_id) REFERENCES `admin` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_hotel ADD CONSTRAINT FK_A379A5233243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hotel ADD gerant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED9A500A924 FOREIGN KEY (gerant_id) REFERENCES gerant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3535ED9A500A924 ON hotel (gerant_id)');
        $this->addSql('ALTER TABLE reservation ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('ALTER TABLE suite ADD hotel_id INT DEFAULT NULL, ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suite ADD CONSTRAINT FK_153CE4263243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE suite ADD CONSTRAINT FK_153CE426B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_153CE4263243BB18 ON suite (hotel_id)');
        $this->addSql('CREATE INDEX IDX_153CE426B83297E7 ON suite (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin_hotel');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED9A500A924');
        $this->addSql('DROP INDEX UNIQ_3535ED9A500A924 ON hotel');
        $this->addSql('ALTER TABLE hotel DROP gerant_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP client_id');
        $this->addSql('ALTER TABLE suite DROP FOREIGN KEY FK_153CE4263243BB18');
        $this->addSql('ALTER TABLE suite DROP FOREIGN KEY FK_153CE426B83297E7');
        $this->addSql('DROP INDEX IDX_153CE4263243BB18 ON suite');
        $this->addSql('DROP INDEX IDX_153CE426B83297E7 ON suite');
        $this->addSql('ALTER TABLE suite DROP hotel_id, DROP reservation_id');
    }
}
