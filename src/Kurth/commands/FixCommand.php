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
use pocketmine\item\Armor;

use Kurth\Essentials;

class FixCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("fix", "repair your tools and armor");
        parent::setAliases(["repair"]);
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!isset ($args[0])) {
            return;
        }

        switch($args[0]) {
            case "help":
                $sender->sendMessage(TextFormat::colorize("&6Fix Commands (1/1)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/{$commandLabel} help &7(view list commands)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/{$commandLabel} hand &7(repair item in hand)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/{$commandLabel} all &7(repair all items incluyed armor)"));
            break;
            case "hand":
                $index = $sender->getInventory()->getHeldItemIndex();
                $item = $sender->getInventory()->getItem($index);
                if ($item instanceof Sword || $item instanceof Pickaxe || $item instanceof Axe || $item instanceof Shovel || $item instanceof Hoe || $item instanceof Bow || $item instanceof Armor) {
                    $sender->getInventory()->setItem($index, $item->setDamage(0));
                    $sender->sendMessage(TextFormat::colorize("&6Fix &8» &fitem in hand has been repaired"));
                }
            break;
            case "all":
                if (!$sender->hasPermission("fix.use.cmd")) {
                    return;
                }

                $sender->sendMessage(TextFormat::colorize("&6Fix &8» &fall inventory items (including armor) have been repaired"));
                foreach ($sender->getInventory()->getContents() as $index => $item) {
                    if ($item instanceof Sword || $item instanceof Pickaxe || $item instanceof Axe || $item instanceof Shovel || $item instanceof Hoe || $item instanceof Bow || $item instanceof Armor) {
                        if ($item->getDamage() > 0) {
                            $sender->getInventory()->setItem($index, $item->setDamage(0));
                        }
                    }
                }

                foreach ($sender->getArmorInventory()->getContents() as $index => $item) {
                    if ($item instanceof Armor) {
                        if ($item->getDamage() > 0) {
                            $sender->getArmorInventory()->setItem($index, $item->setDamage(0));
                        }
                    }
                }
            break;
            default:
            $sender->sendMessage(TextFormat::colorize("&6Fix &8» &fusage /{$commandLabel} help"));
            break;
        }
        return;
    }
}