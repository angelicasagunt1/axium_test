<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251029165944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Sets default sequence for unidad_medida ID and inserts fixed unit records for invoicing.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE unidad_medida ALTER COLUMN id_unidad_medida SET DEFAULT nextval('unidad_medida_id_unidad_medida_seq')");

        $this->addSql("INSERT INTO unidad_medida (codigo, unidad_medida) VALUES 
          ('KG', 'Kilogramo'),
          ('LT', 'Litro'),
          ('UN', 'Unidad'),
          ('MT', 'Metro'),
          ('CM', 'Centímetro')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("ALTER TABLE unidad_medida ALTER COLUMN id_unidad_medida DROP DEFAULT");

        $this->addSql("DELETE FROM unidad_medida WHERE codigo IN ('KG', 'LT', 'UN', 'MT', 'CM')");
    }
}
