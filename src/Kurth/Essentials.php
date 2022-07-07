<?php

namespace Kurth;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\ClosureTask;
use pocketmine\event\player\PlayerItemHeldEvent;

use Kurth\commands\AutofeedCommand;
use Kurth\commands\BroadcastCommand;
use Kurth\commands\ClearentitiesCommand;
use Kurth\commands\EnderchestCommand;
use Kurth\commands\FeedCommand;
use Kurth\commands\FlyCommand;
use Kurth\commands\FixCommand;
use Kurth\commands\GamemodeCommand;
use Kurth\commands\HealthCommand;
use Kurth\commands\ItemidCommand;
use Kurth\commands\PingCommand;
use Kurth\commands\RenameCommand;
use Kurth\commands\SpawnCommand;
use Kurth\commands\StaffchatCommand;

use muqsit\invmenu\InvMenuHandler;

class Essentials extends PluginBase implements Listener {

    public $autofeed = [];
    public $itemid = [];

    private static $instance;

    public function getInstance() : Essentials {
        return self::$instance;
    }

    public function onLoad() : void {
        self::$instance = $this;
    }

    public function onEnable() : void {
        $plugin = $this->getServer()->getPluginManager();
        $plugin->registerEvents($this, $this);

        $command = $this->getServer()->getCommandMap();
        $command->register("autofeed", new AutofeedCommand($this));
        $command->register("broadcast", new BroadcastCommand($this));
        $command->register("clearentities", new ClearentitiesCommand($this));
        $command->register("ec", new EnderchestCommand($this));
        $command->register("feed", new FeedCommand($this));
        $command->register("fly", new FlyCommand($this));
        $command->register("fix", new FixCommand($this));
        $command->register("gm", new GamemodeCommand($this));
        $command->register("health", new HealthCommand($this));
        $command->register("itemid", new ItemidCommand($this));
        $command->register("ping", new PingCommand($this));
        $command->register("rename", new RenameCommand($this));
        $command->register("spawn", new SpawnCommand($this));
        $command->register("staffchat", new StaffchatCommand($this));

        $task = $this->getScheduler();
        $task->scheduleRepeatingTask(new ClosureTask(function () : void {
            foreach ($this->getServer()->getOnlinePlayers() as $players) {
                if (in_array ($players->getName(), $this->autofeed)) {
                    $players->getHungerManager()->setFood(20);
                    $players->getHungerManager()->setSaturation(20);
                }
            }
        }), 0 * 20);

        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
    }

    public function onItem(PlayerItemHeldEvent $event) : void {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if (in_array ($player->getName(), $this->itemid)) {
            $player->sendTip(TextFormat::colorize("&cItemID: &f").$item->getId().":".$item->getMeta());
        }
    }
}