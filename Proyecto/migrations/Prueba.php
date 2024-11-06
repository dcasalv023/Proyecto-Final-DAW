<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241106151746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Empty migration to sync metadata';
    }

    public function up(Schema $schema): void
    {
        // No changes here
    }

    public function down(Schema $schema): void
    {
        // No changes here
    }
}
