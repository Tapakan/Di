<?php
/**
 * ContainerBuilderTest
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di\Tests\unit;

use Tapakan\Di\ContainerBuilder;

/**
 * Class ContainerBuilderTest
 */
class ContainerBuilderTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->container = new ContainerBuilder();

        $this->beforeSpecify(function () {
            $this->container->register('fake', '\Tapakan\Di\Tests\unit\classes\FakeClass');
            $this->container->register('user', '\Tapakan\Di\Tests\unit\classes\FakeUser');
        });
    }

    /**
     * Testing set definition
     */
    public function testRegisterDefinition()
    {
        $this->specify("Try to set definitions", function () {
            $this->container->register('key', 'value');
            $this->container->register(1, 'integer');
            $this->container->register('1.0', 'float');

            verify($this->container->hasDefinition('key'))->true();
            verify($this->container->hasDefinition('1'))->true();
            verify($this->container->hasDefinition(1))->true();
            verify($this->container->hasDefinition('1.0'))->true();
            verify($this->container->countDefinitions())->equals(3);
        });

        $this->specify("Try to set definition with empty key", function () {
            $this->container->register('', '1');
            $this->container->register('  ', '2');

            verify($this->container->countDefinitions())->equals(2);
        });

        $this->specify("Try to check not existing definition", function () {
            verify($this->container->hasDefinition('veryLongKeyForDependency'))->false();
        });

        $this->cleanSpecify();
    }

    /**
     * Test get definition
     */
    public function testGetDefinition()
    {
        $this->specify("Test get unknown service from container", function () {
            verify($this->container->get('app'));
        }, ['throws' => 'Tapakan\Di\Exception\ServiceNotFoundException']);

        $this->cleanSpecify();
    }

    public function testGetService()
    {
        $this->specify("Test get service", function () {
            $firstInstance  = $this->container->get('fake');
            $secondInstance = $this->container->get('fake');
            $userInstance   = $this->container->get('user');

            verify($firstInstance)->isInstanceOf('\Tapakan\Di\Tests\unit\classes\FakeClass');
            verify($secondInstance)->isInstanceOf('\Tapakan\Di\Tests\unit\classes\FakeClass');
            verify($secondInstance)->equals($firstInstance);
            verify($userInstance)->isInstanceOf('\Tapakan\Di\Tests\unit\classes\FakeUser');
        });
    }
}
