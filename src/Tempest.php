<?php

namespace Tempest;

use Symfony\Component\Console\Application as SymfonyApplication;
use Slim\Slim;
use Tempest\Commands\Migrations\MigrateCommand;

class Tempest extends SymfonyApplication
{
    /**
     * The Slim Framework instance.
     *
     * @var \Slim\Slim
     */
    protected $slim;

    /**
     * Creates a new Tempest console application.
     *
     * @param string $name
     * @param string $version
     * @return void
     */
    public function __construct(Slim $slim, $version)
    {
        parent::__construct('Slim Framework', $version);

        $this->slim = $slim;

        $this->addDefaultCommands();
    }

    /**
     * Adds the default console commands.
     *
     * @return void
     */
    protected function addDefaultCommands()
    {
        $this->add(new MigrateCommand());
    }
}
