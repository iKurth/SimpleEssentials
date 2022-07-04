<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class BroadcastCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("broadcast", "send global messages on the server");
        parent::setPermission("broadcast.use.cmd");
        parent::setAliases(["bc", "alert"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!$this->testPermission($sender)) {
            return;
        }

        if (!isset ($args[0])) {
            return;
        }

        $this->plugin->getServer()->broadcastMessage(TextFormat::colorize("&c[{$sender->getName()}] &8» &f").implode(" ", $args));
        return;
    }
}