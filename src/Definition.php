<?php
/**
 * Definition
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di;

/**
 * Class Definition
 */
class Definition implements DefinitionInterface
{
    /**
     * Class name
     * @var string
     */
    private $class;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @var array
     */
    private $properties;

    /**
     * Definition constructor.
     *
     * @param string $class     Class name
     * @param array  $arguments Arguments that passed to class
     */
    public function __construct($class, array $arguments = [])
    {
        $this->class = $class;
        $this->setArguments($arguments);
    }

    /**
     * @param mixed $class
     *
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Sets the service class.
     * @return string Service class
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param array $arguments
     *
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @param mixed $argument
     *
     * @return $this
     */
    public function addArgument($argument)
    {
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $properties
     *
     * @return $this
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }
}
