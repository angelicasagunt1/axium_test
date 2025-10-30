<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251029184928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates producto_servicio table with foreign keys to rubro, unidad_medida, and condicion_iva.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE producto_servicio_id_producto_servicio_seq INCREMENT BY 1 MINVALUE 1 START 1');

        $this->addSql('CREATE TABLE producto_servicio (
            id_producto_servicio INT NOT NULL,
            id_rubro INT NOT NULL,
            tipo CHAR(1) NOT NULL,
            id_unidad_medida INT NOT NULL,
            codigo VARCHAR(20) NOT NULL,
            producto_servicio VARCHAR(255) NOT NULL,
            id_condicion_iva INT NOT NULL,
            precio_bruto_unitario NUMERIC(30,2) NOT NULL,
            PRIMARY KEY(id_producto_servicio)
        )');

        $this->addSql("ALTER TABLE producto_servicio ALTER COLUMN id_producto_servicio SET DEFAULT nextval('producto_servicio_id_producto_servicio_seq')");

        $this->addSql('ALTER TABLE producto_servicio ADD CONSTRAINT fk_producto_servicio_rubro FOREIGN KEY (id_rubro) REFERENCES rubro (id_rubro) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto_servicio ADD CONSTRAINT fk_producto_servicio_unidad FOREIGN KEY (id_unidad_medida) REFERENCES unidad_medida (id_unidad_medida) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE producto_servicio ADD CONSTRAINT fk_producto_servicio_condicion_iva FOREIGN KEY (id_condicion_iva) REFERENCES condicion_iva (id_condicion_iva) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE producto_servicio');
        $this->addSql('DROP SEQUENCE producto_servicio_id_producto_servicio_seq CASCADE');
    }
}
