<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * ProjectServiceContainer.
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class ProjectServiceContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->services = array();
        $this->methodMap = array(
            'tests\\a' => 'getTests_AService',
            'tests\\b' => 'getTests_BService',
        );

        $this->aliases = array();
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        return true;
    }

    /**
     * Gets the 'tests\a' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\A A Tests\A instance
     */
    protected function getTests_AService()
    {
        return $this->services['tests\a'] = new \Tests\A();
    }

    /**
     * Gets the 'tests\b' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\B A Tests\B instance
     */
    protected function getTests_BService()
    {
        return $this->services['tests\b'] = new \Tests\B($this->get('tests\a'));
    }
}
