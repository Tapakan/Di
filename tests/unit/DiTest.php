<?php
/**
 * DiTest
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di\Tests;

use Tapakan\Di\Container;

/**
 * Class DiTest
 */
class DiTest extends \Codeception\Test\Unit
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
     * Testing set dependency
     */
    public function testSetDependency()
    {
        $this->specify("Try set dependency with simple key and value", function () {
            $this->container->set('key', 'value');
            $this->container->set(1, 'integer');
            $this->container->set('1.0', 'float');

            verify($this->container->get('key'))->equals('value');
            verify($this->container->get('1'))->equals('integer');
            verify($this->container->get(1))->equals('integer');
            verify($this->container->get('1.0'))->equals('float');
        });

        $this->specify("Try set dependency with wrong key and value", function () {
            $this->container->set([], '1');
            $this->container->set([1], '2');

            verify($this->container->get([]))->equals('1');
            verify($this->container->get([1]))->equals('2');
        }, ['throws' => ['Tapakan\Di\Exception\InvalidParamException', 'Invalid key type']]);

        $this->specify("Try get not existing dependency", function () {
            verify($this->container->get('veryLongKeyForDependency'))->notNull();
        }, ['throws' => ['Tapakan\Di\Exception\InvalidParamException', 'Unknown dependency']]);
    }

    /**
     * Test get dependency
     */
    public function testGetDependency()
    {
        $this->beforeSpecify(function () {
            $this->container->set('app', $this);
        });

        $this->specify("Test getting dependency from container", function () {
            verify($this->container->get('app'))->isInstanceOf(get_called_class());
        });

        $this->cleanSpecify(); // removes before/after callbacks
    }
}
