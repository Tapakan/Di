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

/**
 * Class Container
 */
class Container
{
    /**
     * @var array
     */
    private $dependencies = [];

    /**
     * @param string $key
     *
     * @return mixed
     * @throws InvalidParamException Throws exception if
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->dependencies[$key];
        }

        throw new InvalidParamException("Unknown dependency");
    }

    /**
     * Check if dependency exists in container
     *
     * @param string|integer|mixed $key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this->dependencies[$key]) || array_key_exists($key, $this->dependencies);
    }

    /**
     * @param string|integer $key
     * @param mixed          $value
     *
     * @throws InvalidParamException
     */
    public function set($key, $value)
    {
        if (!is_scalar($key)) {
            throw new InvalidParamException('Invalid key type');
        }

        $this->dependencies[$key] = $value;
    }
}
