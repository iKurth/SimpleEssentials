<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class ItemidCommand extends Command {

    private Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("itemid", "show id and meta of the items & blocks");
        parent::setPermission("itemid.use.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!$this->testPermission($sender)) {
            return;
        }

        if (!in_array ($sender->getName(), $this->plugin->itemid)) {
            $this->plugin->itemid[] = $sender->getName();
            
            $sender->sendTitle(TextFormat::colorize("&cItemID\n&7activated"));
            $sender->sendMessage(TextFormat::colorize("&cItemID &8» &fitemid has been activated"));

        } else {

            if (in_array($sender->getName(), $this->plugin->itemid)) {
                unset($this->plugin->itemid[array_search($sender->getName(), $this->plugin->itemid)]);

                $sender->sendTitle(TextFormat::colorize("&cItemID\n&7desactivated"));
                $sender->sendMessage(TextFormat::colorize("&cItemID &8» &fitemid has been desactivated"));
            }
        }
        return;
    }
}