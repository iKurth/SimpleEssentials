<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class SpawnCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("spawn", "return to spawn");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if ($sender instanceof Player) {
            $spawn = $this->plugin->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn();
            $sender->teleport($spawn);
            $sender->sendMessage(TextFormat::colorize("&eSpawn &8» &fyou have returned to spawn"));
        }
        return;
    }
}