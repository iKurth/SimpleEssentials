<?php

namespace Kurth\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\player\Player;
use pocketmine\player\GameMode;

use Kurth\Essentials;

class GamemodeCommand extends Command {

    private Essentials $plugin;

    public function __construct(Essentials $plugin) {
        parent::__construct("gm", "change your gamemode easily");
        parent::setPermission("gm.use.cmd");
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

        switch($args[0]) {
            case "help":
                $sender->sendMessage(TextFormat::colorize("&cGamemode Commands (1/1)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/gm help &7(view list commands)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/gm 0|s &7(change gamemode to survival)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/gm 1|c &7(change gamemode to creative)"));
                $sender->sendMessage(TextFormat::colorize("&8- &f/gm 3|e &7(change gamemode to spectator)"));
            break;
            case "0":
                $sender->setGamemode(GameMode::SURVIVAL());
                $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fchanged game mode to: &esurvival"));
            break;
            case "s":
                $sender->setGamemode(GameMode::SURVIVAL());
                $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fchanged game mode to: &esurvival"));
            break;
            case "1":
                $sender->setGamemode(GameMode::CREATIVE());
                $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fchanged game mode to: &ecreative"));
            break;
            case "c":
                $sender->setGamemode(GameMode::CREATIVE());
                $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fchanged game mode to: &ecreaive"));
            break;
            case "3":
                $sender->setGamemode(GameMode::SPECTATOR());
                $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fchanged game mode to: &espectator"));
            break;
            case "e":
                $sender->setGamemode(GameMode::SPECTATOR());
                $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fchanged game mode to: &espectator"));
            break;
            default:
            $sender->sendMessage(TextFormat::colorize("&cGamemode &8» &fusage /gm help"));
            break;
        }
        return;
    }
}