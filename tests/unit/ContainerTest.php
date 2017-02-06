<?php
/**
 * ContainerTest
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di\Tests\unit;

use Tapakan\Di\Container;

/**
 * Class ContainerTest
 */
class ContainerTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->container = new Container();
    }

    /**
     * Testing set service
     */
    public function testSetService()
    {
        $this->specify("Try to set services", function () {
            $this->container->set('key', 'value');
            $this->container->set(1, 'integer');
            $this->container->set('1.0', 'float');

            verify($this->container->has('key'))->true();
            verify($this->container->has('1'))->true();
            verify($this->container->has(1))->true();
            verify($this->container->has('1.0'))->true();
        });

        $this->specify("Try to set definition with empty key", function () {
            $this->container->set('', '1');
            $this->container->set('  ', '2');

            verify($this->container->countServices())->equals('2');
        });

        $this->specify("Try get not existing definition", function () {
            verify($this->container->has('veryLongKeyForDependency'))->false();
        });
    }

    /**
     * Test get service
     */
    public function testGetService()
    {
        $this->beforeSpecify(function () {
            $this->container->set('app', 'App');
        });

        $this->specify("Test get service from container", function () {
            verify($this->container->get('app'))->equals('App');
        });

        $this->specify("Test get unknown service from container", function () {
            verify($this->container->get('veryLongKeyForDependency'));
        }, ['throws' => 'Tapakan\Di\Exception\ServiceNotFoundException']);

        $this->cleanSpecify();
    }
}
