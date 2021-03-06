<?php

namespace Concretehouse\Component\Factory;

use Concretehouse\Component\Factory\FunctionsInterface;
use Concretehouse\Component\Factory\FixedTypeInterface;

/**
 * Registerable fixed type factory.
 */
class RegisterableFixedType extends Registerable implements FixedTypeInterface
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var \ReflectionClass
     */
    private $reflection;


    /**
     * @param string $type
     * @param FunctionsInterface $functions
     */
    public function __construct($type, FunctionsInterface $functions)
    {
        $this->type = $type;
        parent::__construct($functions);
    }

    /**
     * @param string $name
     * @param array $args
     * @return object  Specified in ctor
     */
    public function make($name, array $args = array())
    {
        $object = parent::make($name, $args);
        $type = $this->getType();

        if (!$object instanceof $type) {
            $class = get_class($object);
            throw new \UnexpectedValueException("Object must child of {$type}({$name}:{$class})");
        }

        return $object;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
