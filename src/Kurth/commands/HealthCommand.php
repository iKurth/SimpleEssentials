<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class HealthCommand extends Command {

    private Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("health", "regenerate your life bar to the maximum");
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
            $sender->setHealth($sender->getMaxHealth());
            $sender->sendMessage(TextFormat::colorize("&cHealth &8» &flife bar has regenerated"));
        }
    }
}