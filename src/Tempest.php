<?php

namespace Tempest;

use Symfony\Component\Console\Application as SymfonyApplication;
use Tempest\Commands\KeyGenerateCommand;
use Tempest\Commands\TinkerCommand;

class Tempest extends SymfonyApplication
{
    /**
     * Injected services to be used by Tempest.
     *
     * @var array
     */
    protected $services = [];

    /**
     * Creates a new Tempest console application.
     *
     * @param string $name
     * @param string $version
     *
     * @return void
     */
    public function __construct($name, $version)
    {
        parent::__construct($name, $version);

        $this->addDefaultCommands();
    }

    /**
     * Adds the available default commands to Tempest.
     *
     * @return void
     */
    protected function addDefaultCommands()
    {
        $this->add(new KeyGenerateCommand);
        $this->add(new TinkerCommand);
    }

    /**
     * Injects a service to Tempest.
     *
     * @param  string $name
     * @param  mixed $service
     *
     * @return void
     */
    public function inject($name, $service)
    {
        $this->services[$name] = $service;
    }

    /**
     * Gets the injected services.
     *
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Gets an injected service.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function getService($key)
    {
        return $this->services[$key];
    }
}
