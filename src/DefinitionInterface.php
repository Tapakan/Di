<?php
/**
 * DefinitionInterface
 * @version     0.0.1
 * @license     http://mit-license.org/
 * @author      Tapakan https://github.com/Tapakan
 * @coder       Alexander Oganov <t_tapak@yahoo.com>
 */

namespace Tapakan\Di;

/**
 * Interface DefinitionInterface
 */
interface DefinitionInterface
{
    /**
     * Sets the service class.
     * @return string Service class
     */
    public function getClass();
}
