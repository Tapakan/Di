<?php
/**
 * FakeUser
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di\Tests\unit\classes;

/**
 * Class FakeUser
 */
class FakeUser extends FakeClass implements FakeUserInterface
{
    /**
     * @var FakeServiceInterface
     */
    private $service;

    public function __construct(FakeServiceInterface $service)
    {
        $this->service = $service;
    }
}
