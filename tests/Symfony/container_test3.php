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
            'tests\\c' => 'getTests_CService',
            'tests\\d' => 'getTests_DService',
            'tests\\e' => 'getTests_EService',
            'tests\\f' => 'getTests_FService',
            'tests\\g' => 'getTests_GService',
            'tests\\h' => 'getTests_HService',
            'tests\\i' => 'getTests_IService',
            'tests\\j' => 'getTests_JService',
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

    /**
     * Gets the 'tests\c' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\C A Tests\C instance
     */
    protected function getTests_CService()
    {
        return $this->services['tests\c'] = new \Tests\C($this->get('tests\b'));
    }

    /**
     * Gets the 'tests\d' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\D A Tests\D instance
     */
    protected function getTests_DService()
    {
        return $this->services['tests\d'] = new \Tests\D($this->get('tests\c'));
    }

    /**
     * Gets the 'tests\e' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\E A Tests\E instance
     */
    protected function getTests_EService()
    {
        return $this->services['tests\e'] = new \Tests\E($this->get('tests\d'));
    }

    /**
     * Gets the 'tests\f' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\F A Tests\F instance
     */
    protected function getTests_FService()
    {
        return $this->services['tests\f'] = new \Tests\F($this->get('tests\e'));
    }

    /**
     * Gets the 'tests\g' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\G A Tests\G instance
     */
    protected function getTests_GService()
    {
        return $this->services['tests\g'] = new \Tests\G($this->get('tests\f'));
    }

    /**
     * Gets the 'tests\h' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\H A Tests\H instance
     */
    protected function getTests_HService()
    {
        return $this->services['tests\h'] = new \Tests\H($this->get('tests\g'));
    }

    /**
     * Gets the 'tests\i' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\I A Tests\I instance
     */
    protected function getTests_IService()
    {
        return $this->services['tests\i'] = new \Tests\I($this->get('tests\h'));
    }

    /**
     * Gets the 'tests\j' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Tests\J A Tests\J instance
     */
    protected function getTests_JService()
    {
        return $this->services['tests\j'] = new \Tests\J($this->get('tests\i'));
    }
}
