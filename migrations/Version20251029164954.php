<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251029164954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Crea tabla unidad_medida con índices únicos y secuencia para PostgreSQL';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE unidad_medida_id_unidad_medida_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE unidad_medida (
            id_unidad_medida INT NOT NULL DEFAULT nextval(\'unidad_medida_id_unidad_medida_seq\'),
            codigo VARCHAR(5) NOT NULL,
            unidad_medida VARCHAR(50) NOT NULL,
            PRIMARY KEY(id_unidad_medida)
        )');
        $this->addSql('CREATE UNIQUE INDEX unidad_medida_codigo_ux ON unidad_medida (codigo)');
        $this->addSql('CREATE UNIQUE INDEX unidad_medida_ux ON unidad_medida (unidad_medida)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE unidad_medida');
        $this->addSql('DROP SEQUENCE unidad_medida_id_unidad_medida_seq CASCADE');
    }

}
