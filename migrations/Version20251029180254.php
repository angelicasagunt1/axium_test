<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251029180254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the rubro table for product/service categories used in invoicing, with fixed inserts.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE rubro_id_rubro_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rubro (id_rubro INT NOT NULL, rubro VARCHAR(50) NOT NULL, PRIMARY KEY(id_rubro))');
        $this->addSql("ALTER TABLE rubro ALTER COLUMN id_rubro SET DEFAULT nextval('rubro_id_rubro_seq')");

        $this->addSql("INSERT INTO rubro (rubro) VALUES 
          ('Servicios profesionales'),
          ('Productos físicos'),
          ('Consultoría'),
          ('Mantenimiento'),
          ('Licencias de software')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE rubro_id_rubro_seq CASCADE');
        $this->addSql('DROP TABLE rubro');
    }
}
