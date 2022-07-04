<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;

class EnderchestCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("enderchest", "open your portable enderchest");
        parent::setPermission("enderchest.use.cmd");
        parent::setAliases(["ec"]);
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
            $this->getEnderChest($sender);
        }
        return;
    }

    public function getEnderChest(Player $player) : void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TextFormat::colorize("&8EnderChest"));
        $menu->getInventory()->setContents($player->getEnderInventory()->getContents());
        $menu->setListener(function (InvMenuTransaction $transaction) use ($player) : InvMenuTransactionResult {
            $player->getEnderInventory()->setItem($transaction->getAction()->getSlot(), $transaction->getIn());
            return $transaction->continue();
        });
        $menu->send($player);
        return;
    }
}