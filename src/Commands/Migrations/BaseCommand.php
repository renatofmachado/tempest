<?php

namespace Tempest\Commands\Migrations;

use Tempest\Command;

class BaseCommand extends Command
{
    /**
     * Returns the Eloquent instance.
     *
     * @return \Illuminate\Database\Capsule\Manager
     */
    protected function getEloquent()
    {
        return $this->getApplication()->slim->db;
    }

    /**
     * Returns the migrations path.
     *
     * @return string
     */
    protected function getMigrationsPath()
    {
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, __DIR__ . '/database/migrations/');

        return $path;
    }
}
