<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class PingCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("ping", "check your latency in the server");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if ($sender instanceof Player) {
            $ping = $sender->getNetworkSession()->getPing();
            $sender->sendMessage(TextFormat::colorize("&ePing &8» &fyour ping is: &e").$ping);
        }
        return;
    }
}