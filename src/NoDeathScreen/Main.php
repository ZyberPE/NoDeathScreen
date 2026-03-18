<?php

declare(strict_types=1);

namespace NoDeathScreen;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\scheduler\ClosureTask;
use pocketmine\player\Player;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onDeath(PlayerDeathEvent $event): void {
        $player = $event->getPlayer();

        // Delay respawn by 1 tick to fully bypass death screen
        $this->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($player): void {
            if($player->isOnline()){
                $player->respawn();

                // Teleport to default world spawn
                $world = $this->getServer()->getWorldManager()->getDefaultWorld();
                if($world !== null){
                    $player->teleport($world->getSpawnLocation());
                }
            }
        }), 1);
    }
}
