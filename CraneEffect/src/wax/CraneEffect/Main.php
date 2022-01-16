<?php

namespace wax\CraneEffect;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
    public function onEnable () : void
    {
        $this->getServer()->PluginManager()->registerEvent(new EventListener(), $this);
        $this->getLogger()->info("le plugin est activé");
    }
}