<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class FeedCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("feed", "regenerate food bar to the maximum");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if ($sender instanceof Player) {
            if ($sender->getHungerManager()->getFood() < 6) {
                $sender->getHungerManager()->setFood(20);
                $sender->getHungerManager()->setSaturation(10);
                $sender->sendMessage(TextFormat::colorize("&eFeed &8» &ffood bar has been regenerated"));
            }
        }
        return;
    }
}