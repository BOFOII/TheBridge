<?php

namespace bofoiii\TheBridge\command\subcommands;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use bofoiii\TheBridge\TheBridge;

class SetWorldSubCommand extends BaseSubCommand{

    public function prepare(): void
    {
        $this->registerArgument(0, new RawStringArgument("arena", false));
        $this->setPermission("sthebridge.cmd.set");
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     * @return void
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if(!$sender instanceof Player){
            return;
        }

        if(!$this->testPermissionSilent($sender)){
            return;
        }
        if(TheBridge::getInstance()->getGame($args["arena"]) == null){
            $sender->sendMessage("Arena " . $args["arena"] . " Not found!");
            return;
        }
        TheBridge::getInstance()->getGame($args["arena"])->setWorld($sender->getWorld());
        $sender->sendMessage("Succesfully set " . $sender->getWorld()->getFolderName() . " as world arena");
    }
}
