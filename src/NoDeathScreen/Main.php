<?php

declare(strict_types=1);

namespace NoDeathScreen;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerDeathEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    // Optional: clear death message if you want
    public function onDeath(PlayerDeathEvent $event): void {
        // $event->setDeathMessage(""); // optional
    }

    public function onRespawn(PlayerRespawnEvent $event): void {
        $player = $event->getPlayer();

        $world = $this->getServer()->getWorldManager()->getDefaultWorld();
        if($world !== null){
            $event->setRespawnPosition($world->getSpawnLocation());
        }
    }
}
