<?php

namespace Invertus\psModuleTabs\Object;

class Tab
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $className;

    /**
     * @var string | int
     */
    private $parentClassName;

    public function __construct($name, $className, $parentClassName)
    {
        $this->name = $name;
        $this->className = $className;
        $this->parentClassName = $parentClassName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return int|string
     */
    public function getParentClassName()
    {
        return $this->parentClassName;
    }
}
