<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251029183825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the condicion_iva table for VAT conditions used in invoicing, with fixed inserts for common tax categories.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE condicion_iva_id_condicion_iva_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE condicion_iva (
          id_condicion_iva INT NOT NULL,
          codigo SMALLINT NOT NULL,
          condicion_iva VARCHAR(50) NOT NULL,
          alicuota NUMERIC(10,3),
          PRIMARY KEY(id_condicion_iva)
        )');

        $this->addSql("ALTER TABLE condicion_iva ALTER COLUMN id_condicion_iva SET DEFAULT nextval('condicion_iva_id_condicion_iva_seq')");
        $this->addSql('CREATE UNIQUE INDEX condicion_iva_codigo_ux ON condicion_iva (codigo)');
        $this->addSql('CREATE UNIQUE INDEX condicion_iva_ux ON condicion_iva (condicion_iva)');

        $this->addSql("INSERT INTO condicion_iva (codigo, condicion_iva, alicuota) VALUES 
          (1, 'Responsable Inscripto', 21.000),
          (2, 'Monotributista', 0.000),
          (3, 'Exento', 0.000),
          (4, 'Consumidor Final', 0.000),
          (5, 'No Responsable', 0.000)");

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE condicion_iva_id_condicion_iva_seq CASCADE');
        $this->addSql('DROP TABLE condicion_iva');
    }
}
