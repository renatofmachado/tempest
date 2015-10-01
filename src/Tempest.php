<?php

namespace Tempest;

use Symfony\Component\Console\Application as SymfonyApplication;
use Tempest\Commands\KeyGenerateCommand;

class Tempest extends SymfonyApplication
{
    /**
     * Service container.
     *
     * @var mixed
     */
    protected $container;

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
     * @param mixed $container
     *
     * @return void
     */
    public function __construct($name, $version, $container = null)
    {
        parent::__construct($name, $version);
        $this->container = $container;

        $this->addDefaultCommands();
    }

    protected function addDefaultCommands()
    {
        $this->add(new KeyGenerateCommand);
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
     * Gets the service container.
     *
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
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
