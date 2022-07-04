<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;

use Kurth\Essentials;

class AutofeedCommand extends Command {

    public Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("autofeed", "regenerates the food bar automatically");
        parent::setPermission("autofeed.use.cmd");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!$sender instanceof Player) {
            return;
        }

        if (!$this->testPermission($sender)) {
            return;
        }

        if (!in_array ($sender->getName(), $this->plugin->autofeed)) {
            $this->plugin->autofeed[] = $sender->getName();
            
            $sender->sendTitle(TextFormat::colorize("&6Autofeed\n&7activated"));
            $sender->sendMessage(TextFormat::colorize("&6Autofeed &8» &fautofeed has been activated"));

        } else {

            if (in_array($sender->getName(), $this->plugin->autofeed)) {
                unset($this->plugin->autofeed[array_search($sender->getName(), $this->plugin->autofeed)]);

                $sender->sendTitle(TextFormat::colorize("&6Autofeed\n&7desactivated"));
                $sender->sendMessage(TextFormat::colorize("&6Autofeed &8» &fautofeed has been desactivated"));
            }
        }
        return;
    }
}