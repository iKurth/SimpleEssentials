<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use pocketmine\item\Sword;
use pocketmine\item\Pickaxe;
use pocketmine\item\Axe;
use pocketmine\item\Shovel;
use pocketmine\item\Hoe;
use pocketmine\item\Bow;

use Kurth\Essentials;

class RenameCommand extends Command {

    private Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("rename", "rename your tools");
        parent::setPermission("rename.use.cmd");
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

        if (strlen ($args[0]) > 20) {
            return;
        }

        if (strlen ($args[0]) < 5) {
            return;
        }

        if ($sender instanceof Player) {
            $item = $sender->getInventory()->getItemInHand();
            if ($item->isNull()) {
                return;
            }

            if ($item instanceof Sword || $item instanceof Pickaxe || $item instanceof Axe || $item instanceof Shovel || $item instanceof Hoe || $item instanceof Bow) {
                $item->clearCustomName();
                $item->setCustomName(str_replace("&", "§", implode(" ", $args)));
                $sender->getInventory()->setItemInHand($item);
                $sender->sendMessage(TextFormat::colorize("&6Rename &8» &fname of the item in hand has been changed"));
            }
        }
    }
}