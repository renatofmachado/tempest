<?php

namespace Tempest\Commands\Database;

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
        return $this->getSlim()->db;
    }

    /**
     * Generates a path to the given directory.
     *
     * @param  string $dir
     * @return string
     */
    private function pathTo($dir)
    {
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $dir);
    }

    /**
     * Returns the migrations path.
     *
     * @return string
     */
    protected function getMigrationsPath()
    {
        return $this->pathTo(__DIR__ . '/database/migrations/');
    }

    /**
     * Returns the seeds path.
     *
     * @return string
     */
    protected function getSeedsPath()
    {
        return $this->pathTo(__DIR__ . '/database/seeds/');
    }
}
