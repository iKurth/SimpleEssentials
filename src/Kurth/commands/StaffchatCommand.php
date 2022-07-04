<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class StaffchatCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("staffchat", "send private messages for staffs");
        parent::setPermission("staffchat.use.cmd");
        parent::setAliases(["sc"]);
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

        foreach ($this->plugin->getServer()->getOnlinePlayers() as $players) {
            if ($players->hasPermission("staffchat.use.cmd")) {
                $players->sendMessage(TextFormat::colorize("&cStaffChat &8» &f{$sender->getName()}: &7").implode(" ", $args));
            }
        }
        return;
    }
}