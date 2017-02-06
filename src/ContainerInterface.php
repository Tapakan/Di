<?php
/**
 * ContainerInterface
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di;

/**
 * Interface ContainerInterface
 */
interface ContainerInterface
{
    const THROW_EXCEPTIONS = 1;

    public function set($id, $service);

    public function get($id);

    public function has($id);

    public function getParameter($id);

    public function setParameter($id);
}
