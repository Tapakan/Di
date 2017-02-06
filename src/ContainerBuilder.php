<?php
/**
 * ContainerBuilder
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di;

use Tapakan\Di\Exception\ServiceNotFoundException;

/**
 * Class ContainerBuilder
 */
class ContainerBuilder extends Container
{
    /**
     * @var array
     */
    private $definitions = [];

    /**
     * @param string|mixed $id     Service id
     * @param string       $class  Register service
     * @param array        $params Params
     *
     * @return DefinitionInterface
     */
    public function register($id, $class, $params = [])
    {
        $id = $this->prepareId($id);

        return $this->setDefinition($id, new Definition($class));
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        if (parent::has($id)) {
            return parent::get($id);
        }

        $definition = $this->getDefinition($id);

        return parent::set($id, $this->createService($definition));
    }

    /**
     * @inheritdoc
     */
    public function has($id)
    {
        $id = $this->prepareId($id);

        return isset($this->definitions[$id]) || parent::has($id);
    }

    /**
     * @param string              $id         Definition identifier
     * @param DefinitionInterface $definition Instance of ServiceInterface
     *
     * @return DefinitionInterface
     */
    private function setDefinition($id, DefinitionInterface $definition)
    {
        return $this->definitions[$id] = $definition;
    }

    /**
     * @param string $id Definition identifier
     *
     * @return DefinitionInterface|Definition
     * @throws ServiceNotFoundException
     */
    public function getDefinition($id)
    {
        if (isset($this->definitions[$this->prepareId($id)])) {
            return $this->definitions[$id];
        }

        throw new ServiceNotFoundException("Service not found - {$id}");
    }

    /**
     * @param string $id Service identifier
     *
     * @return bool
     */
    public function hasDefinition($id)
    {
        return isset($this->definitions[$this->prepareId($id)]);
    }

    /**
     * @return int
     */
    public function countDefinitions()
    {
        return count($this->definitions);
    }

    /**
     * @param string|mixed $definition Definition instance
     *
     * @return mixed Service instance
     */
    private function createService(Definition $definition)
    {
        $reflection = new \ReflectionClass($definition->getClass());

        $reflection->getConstructor()->getParameters();

        return $reflection->newInstanceWithoutConstructor();
    }
}
