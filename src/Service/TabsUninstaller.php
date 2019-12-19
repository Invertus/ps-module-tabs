<?php

namespace Invertus\psModuleTabs\Service;

use Invertus\psModuleTabs\Object\Tab as ModuleTab;
use Tab;

class TabsUninstaller
{
    /**
     * @var ModuleTab
     */
    private $tabs;

    public function __construct(ModuleTab $tabs)
    {
        $this->tabs = $tabs;
    }

    public function uninstallTabs()
    {
        foreach ($this->tabs as $tab) {
            $idTab = Tab::getIdFromClassName($tab['class_name']);

            if (!$idTab) {
                continue;
            }

            $tab = new Tab($idTab);
            if (!$tab->delete()) {
                return false;
            }
        }

        return true;
    }
}
