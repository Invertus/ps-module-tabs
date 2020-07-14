<?php

namespace Invertus\psModuleTabs\Service;

use Invertus\psModuleTabs\Object\Tab;
use Invertus\psModuleTabs\Object\TabsCollection;
use Language;
use Tab as PsTab;

class TabsInstaller
{
    /**
     * @var TabsCollection
     */
    private $tabs;

    /**
     * @var string
     */
    private $moduleName;

    public function __construct(TabsCollection $tabs, $moduleName)
    {
        $this->tabs = $tabs;
        $this->moduleName = $moduleName;
    }

    public function installTabs()
    {
        $languages = Language::getLanguages(true);

        foreach ($this->tabs as $tab) {
            if (!$tab instanceof Tab) {
                return false;
            }

            if (PsTab::getIdFromClassName($tab->getClassName())) {
                continue;
            }

            if (!$this->installTab($tab, $languages)) {
                return false;
            }
        }

        return true;
    }

    private function installTab(Tab $tab, $languages)
    {
        $parentClassName = $tab->getParentClassName();
        $idParent = is_int($parentClassName) ? $parentClassName : PsTab::getIdFromClassName($parentClassName);

        $psTab = new PsTab();
        $psTab->class_name = $tab->getClassName();
        $psTab->id_parent  = $idParent;
        $psTab->module     = $this->moduleName;
        $psTab->active = $tab->isActive();

        foreach ($languages as $language) {
            $psTab->name[$language['id_lang']] = $tab->getName();
        }

        if (!$psTab->save()) {
            return false;
        }

        return true;
    }
}
