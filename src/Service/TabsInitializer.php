<?php

namespace Invertus\psModuleTabs\Service;

use Invertus\psModuleTabs\Object\TabsCollection;

class TabsInitializer
{
    /**
     * @var string
     */
    private $psVersion;

    /**
     * @var TabsCollection
     */
    private $tabs;

    /**
     * TabsInitializer constructor.
     *
     * @param $psVersion
     * @param TabsCollection $tabs
     */
    public function __construct($psVersion, TabsCollection $tabs)
    {
        $this->psVersion = $psVersion;
        $this->tabs = $tabs;
    }

//    TODO: need uninstall functionality

    /**
     * @return bool
     */
    public function initializeTabsByPsVersion()
    {
        if ($this->isPSVersionLessThan174()) {
            $tabsInstaller = new TabsInstaller($this->tabs);
            if (!$tabsInstaller->installTabs()) {
                return false;
            };
        }

        return true;
    }

    /**
     * @return bool
     */
    private function isPSVersionLessThan174()
    {
        return (bool) version_compare($this->psVersion, '1.7.4', '<');
    }
}
