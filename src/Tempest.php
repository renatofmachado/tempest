<?php

namespace Tempest;

use Symfony\Component\Console\Application as SymfonyApplication;
use Tempest\Commands\HelloCommand;

class Tempest extends SymfonyApplication
{
    /**
     * Creates a new Tempest console application.
     *
     * @param string $name
     * @param string $version
     * @return void
     */
    public function __construct($name, $version)
    {
        parent::__construct($name, $version);

        $this->addDefaultCommands();
    }

    /**
     * Adds the default console commands.
     *
     * @return void
     */
    protected function addDefaultCommands()
    {
        $this->add(new HelloCommand());
    }
}
