<?php
/**
 * DefinitionTest
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di\Tests\unit;

use Tapakan\Di\Container;
use Tapakan\Di\Definition;

/**
 * Class DefinitionTest
 */
class DefinitionTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @var Definition
     */
    protected $definition;

    /**
     * @inheritdoc
     */
    public function _before()
    {
        $this->definition = new Definition(Container::class, [
            'argument' => 'value'
        ]);
    }

    /**
     * Test setters and getters of definition class
     */
    public function testSettersAndGetters()
    {
        $this->specify("Test default class property", function () {
            verify($this->definition->getClass())->equals(Container::class);
        });

        $this->specify("Test set class property", function () {
            $this->definition->setClass(static::class);
            verify($this->definition->getClass())->equals(static::class);
        });

        $this->specify("Test default argument property", function () {
            verify($this->definition->getArguments())->count(1);
        });

        $this->specify("Test set argument property", function () {
            $this->definition->addArgument('arguments');
            verify($this->definition->getArguments())->count(2);
        });
    }
}
