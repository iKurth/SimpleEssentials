<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use pocketmine\entity\object\ExperienceOrb;
use pocketmine\entity\object\ItemEntity;

use Kurth\Essentials;

class ClearentitiesCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("clearentities", "remove all entities from the server");
        parent::setPermission("clearentities.use.cmd");
        parent::setAliases(["clearlag", "anti-lag"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!$this->testPermission($sender)) {
            return;
        }

        $sender->sendMessage(TextFormat::colorize("&cClear-Lag &8» &fall entities has been removed"));

        foreach ($this->plugin->getServer()->getWorldManager()->getWorlds() as $world) {
            foreach ($world->getEntities() as $entities) {
                if ($entities instanceof ItemEntity || $entities instanceof ExperienceOrb) {
                    $entities->flagForDespawn();
                }
            }
        }
        return;
    }
}