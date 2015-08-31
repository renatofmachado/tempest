<?php

namespace Tempest\Commands\Database\Migrations;

use Tempest\Commands\Database\BaseCommand;

class MigrateCommand extends BaseCommand
{
    protected $name = 'migrate';

    protected $description = 'Migrates the database.';

    /**
     * Strips all of the underscores within the given string.
     *
     * @param  string $string
     * @return string
     */
    protected function stripUnderscore($string)
    {
        $string[0] = strtoupper($string[0]);
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] === '_') {
                $string[$i + 1] = strtoupper($string[$i + 1]);
            }
        }
        return str_replace('_', '', $string);
    }

    /**
     * Returns the migration class name.
     *
     * @param  string $migration
     * @return string
     */
    protected function getMigrationClassName($migration)
    {
        $file = basename($migration);
        $class = stripUnderscore($file);
        return str_replace('.php', '', $class);
    }

    protected function handle()
    {
        $migrations = glob($this->getMigrationsPath() . '*.php');

        foreach ($migrations as $migration) {
            $class = getMigrationClassName($migration);

            (new $class)->$method();

            if ($method === 'up') {
                echo $class . ' migration was successful.' . PHP_EOL;
            } else {
                echo $class . ' migration was successfully reset.' . PHP_EOL;
            }
        }
    }
}
