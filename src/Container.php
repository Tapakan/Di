<?php
/**
 * Container
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di;

use Tapakan\Di\Exception\InvalidParamException;
use Tapakan\Di\Exception\ServiceNotFoundException;

/**
 * Class Container
 */
class Container implements ContainerInterface
{
    const THROW_EXCEPTION = 0;

    /**
     * @var \ArrayObject
     */
    protected $config;

    /**
     * @var array
     */
    protected $services = [];

    /**
     * Container constructor.
     *
     * @param array|null $config
     */
    public function __construct(array $config = [])
    {
        $this->config = new \ArrayObject($config);
    }

    /**
     * @param string|integer $id
     * @param mixed          $service
     *
     * @return mixed
     * @throws InvalidParamException
     */
    public function set($id, $service)
    {
        $id = $this->prepareId($id);

        $this->services[$id] = $service;

        if (null === $service) {
            unset($this->services[$id]);
        }

        return $service;
    }

    /**
     * Return a service.
     *
     * @param string|mixed $id
     *
     * @return mixed
     * @throws ServiceNotFoundException
     *
     */
    public function get($id)
    {
        if (isset($this->services[$id])) {
            return $this->services[$id];
        }

        throw new ServiceNotFoundException("Service not found - {$id}");
    }

    /**
     * Check if dependency exists in container
     *
     * @param string|integer|mixed $id
     *
     * @return bool
     */
    public function has($id)
    {
        return isset($this->services[$this->prepareId($id)]);
    }

    /**
     * @return int
     */
    public function countServices()
    {
        return count($this->services);
    }

    public function getParameter($id)
    {
        // TODO: Implement getParameter() method.
    }

    public function setParameter($id)
    {
        // TODO: Implement setParameter() method.
    }

    /**
     * @param mixed $id
     *
     * @return string
     */
    protected function prepareId($id)
    {
        return (string)$id;
    }
}
