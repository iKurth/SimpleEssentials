<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class FlyCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("fly", "fly without creative");
        parent::setPermission("fly.use.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!$this->testPermission($sender)) {
            return;
        }

        if ($sender instanceof Player) {
            if ($sender->getAllowFlight() === false) {
                $sender->setAllowFlight(true);
                $sender->sendMessage(TextFormat::colorize("&6Fly &8» &fflight mode has been activated"));

            } else {
                
                $sender->setAllowFlight(false);
                $sender->setFlying(false);
                $sender->sendMessage(TextFormat::colorize("&6Fly &8» &fflight mode has been desactivated"));
            }
        }
        return;
    }
}